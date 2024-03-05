<?php

namespace Modules\Product\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Faker\Core\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Product\App\Models\Product;
use Modules\Product\App\Services\FileUploader;

class ProductImageController extends Controller
{

    public function __construct(private FileUploader $fileUploader)
    {
    }

    public function editImage(Product $product)
    {
        return view('product::image', compact('product'));
    }

    public function updateImage(Request $request, Product $product)
    {
        if ($request->has('primary_image')) {
            $primaryImage = $this->fileUploader->upload($request
                ->file('primary_image'), env('PUBLIC_IMAGE_UPLOADE_PATH'));
            $product->primary_image = $primaryImage;
            $product->save();
        }

        if ($request->has('images')) {
            $secondaryImages = $this->fileUploader->uploadFiles($request
                ->file('images'), env('PUBLIC_IMAGES_UPLOADE_PATH'));

            $imageData = array_map(function ($image) {
                return ['image' => $image];
            }, $secondaryImages);
            $product->images()->createMany($imageData);
        }
        return redirect()->back()->with('success', 'آپدیت عکس با موفقیت انجام شد');
    }

    public function deleteImage(Request $request, Product $product)
    {
        $product->images()->where('image', $request->image_id)->first()->delete();
        return redirect()->back();
    }
}
