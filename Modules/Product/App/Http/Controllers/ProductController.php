<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Product\App\Http\Requests\StoreProductRequest;
use Modules\Product\App\Models\Brand;
use Modules\Product\App\Models\Category;
use Modules\Product\App\Models\Tag;
use Modules\Product\App\Repositories\Contract\IProductRepository;
use Modules\Product\App\Services\FileUploader;

class ProductController extends Controller
{

    public function __construct(private IProductRepository $productRepository, private FileUploader $fileUploader)
    {
    }

    public function create()
    {
        $brands = Brand::all();
        $categories = Category::query()->whereNotNull('parent_id')->get();
        $tags = Tag::all();
        return view('product::create', compact('brands', 'categories', 'tags'));
    }

    public function store(StoreProductRequest $request)
    {
        try {
            $productData = $request->validated();
            $productData['primary_image'] = $this->fileUploader->upload($request->file('primary_image'), 'product_images');
            $product = $this->productRepository->store($productData);
            $images = $this->fileUploader->uploadFiles($request->file('images'), 'product_sec_images');
            $this->productRepository->storeImages($product, $images);
            $this->productRepository->storeAttributes($product, $productData['attribute_ids']);
            $this->productRepository->storeVariationAttributes($product, $productData['variation_values']);
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->with('failed', 'خطای سیستمی');
        }
        return redirect()->route('product.index')->with('success', 'محصول با موفقیت ایجاد شد');
    }

    public function attributeCategory(Category $category)
    {
        return response()->json($category->withFilterAttribute());
    }

}
