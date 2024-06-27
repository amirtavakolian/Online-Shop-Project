<?php

namespace Modules\Cart\App\Services\Cart;

use Carbon\Carbon;
use Modules\Cart\App\Models\ProductVariation;
use Modules\Cart\App\Services\SessionService;

class SessionCartService implements ICartService
{
    const CART_SESSION_KEY = 'cart';
    const PRODUCT_IS_NOT_EXISTS = 'محصول انتخابی موجود نمیباشد';
    const NOT_ENOUGH_STOCK = 'موجودی انبار کافی نیست';

    public function __construct(private SessionService $sessionService)
    {
    }

    public function add($variantId)
    {
        $product = $this->checkProductQuantity($variantId);

        if ($product == self::PRODUCT_IS_NOT_EXISTS) {
            return self::PRODUCT_IS_NOT_EXISTS;
        }

        if ($product == self::NOT_ENOUGH_STOCK) {
            return self::NOT_ENOUGH_STOCK;
        }

        if ($this->sessionService->exists(self::CART_SESSION_KEY . "." . $variantId)) {
            $this->appendToCart($variantId, $product);
        } else {
            $generatedData = $this->generateProductData($product);
            $this->sessionService->add(self::CART_SESSION_KEY . "." . $variantId, $generatedData);
        }
        return $this->sessionService->get(self::CART_SESSION_KEY);
    }

    private function checkProductQuantity($variantId)
    {
        $product = ProductVariation::find($variantId);

        if (!$product) {
            return self::PRODUCT_IS_NOT_EXISTS;
        }

        if ($product->quantity < 1) {
            return self::NOT_ENOUGH_STOCK;
        }
        return $product;
    }

    private function generateProductData($product, $quantity = 1)
    {
        $productData = [
            "id" => $product->product->id,
            "name" => $product->product->name,
            "image" => $product->product->primary_image,
            "quantity" => $quantity,
            "price" => $product->price,
            "attribute" => $product->attribute->name,
            "attribute_value" => $product->value
        ];
        if ($product->date_on_sale_from != null && $product->date_on_sale_to != null) {
            if (Carbon::parse($product->date_on_sale_from)->lte(Carbon::now()) &&
                Carbon::now()->lte($product->date_on_sale_to)) {
                $productData['sale_price'] = $product->sale_price;
                $productData['date_on_sale_from'] = $product->date_on_sale_from;
                $productData['date_on_sale_to'] = $product->date_on_sale_to;
            }
        }
        return $productData;
    }

    private function appendToCart($variantId, $product)
    {
        $existProductQuantity = $this->sessionService->get(self::CART_SESSION_KEY . "." . $variantId)['quantity'] + 1;
        $this->sessionService->add(self::CART_SESSION_KEY . "." . $variantId, $this->generateProductData($product, $existProductQuantity));
    }
}
