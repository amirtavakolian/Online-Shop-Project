<?php

namespace Modules\Product\App\Observers;


use Illuminate\Support\Facades\Storage;
use Modules\Product\App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product): void
    {
    }

    public function update(Product $product)
    {
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        Storage::delete('public/' . $product->getOriginal('primary_image'));
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
    }
}
