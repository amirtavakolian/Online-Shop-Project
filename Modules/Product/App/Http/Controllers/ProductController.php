<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Product\App\Http\Requests\StoreProductRequest;
use Modules\Product\App\Http\Requests\UpdateProductCategoryRequest;
use Modules\Product\App\Http\Requests\UpdateProductRequest;
use Modules\Product\App\Models\Brand;
use Modules\Product\App\Models\Category;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Models\Tag;
use Modules\Product\App\Repositories\Contract\IProductRepository;
use Modules\Product\App\Services\FileUploader;

class ProductController extends Controller
{

    public function __construct(private IProductRepository $productRepository, private FileUploader $fileUploader)
    {
    }

    public function index()
    {
        $products = Product::all();
        return view('product::index', compact('products'));
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
        return response()->json($category->withAttributes());
    }

    public function edit(Product $product)
    {
        $brands = Brand::all();
        $tags = Tag::all();
        return view('product::edit', compact('product', 'brands', 'tags'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->update($product, $request->validated());
        return redirect()->route('product.index')->with('success', 'آپدیت با موفقیت انجام شد');
    }

    public function editCategory(Product $product)
    {
        $categories = Category::query()->whereNotNull('parent_id')->get();
        return view('product::updatecategory', compact('product', 'categories'));
    }

    public function updateCategory(UpdateProductCategoryRequest $request, Product $product)
    {
        $product->category_id = $request->input('category_id');
        $product->save();

        foreach ($request->input('attribute_ids') as $key => $attribute) {
            $attributes[$key]['value'] = $attribute;
        }
        $product->attributes()->sync($attributes);

        $variationAttributes = [];
        foreach ($request->variation_values as $key => $variationAttribute) {
            foreach ($variationAttribute as $variationAttributeKey => $attribute) {
                $variationAttributes[$variationAttributeKey][$key] = $attribute;
                $variationAttributes[$variationAttributeKey]['attribute_id'] = $request->attribute_id;
            }
        }
        $product->variationAttribute()->detach();
        $product->variationAttribute()->sync($variationAttributes);
        return redirect()->route('product.index')->with('success', 'آپدیت با موفقیت انجام شد');
    }


}
