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
        $product = ProductVariation::find($variantId);

        if (!$product) {
            return self::PRODUCT_IS_NOT_EXISTS;
        }

        if ($product->quantity < 1) {
            return self::NOT_ENOUGH_STOCK;
        }

        if ($this->sessionService->exists(self::CART_SESSION_KEY . "." . $variantId)) {
            $this->appendToCart($variantId, $product);
        } else {
            $this->sessionService->add(self::CART_SESSION_KEY . "." . $variantId, $this->generateProductData($product));
        }

        $this->sessionService->add('totalCartPrice', $this->calculateTotalCartPrice());
        return $this->sessionService->get(self::CART_SESSION_KEY);
    }

    private function generateProductData($product, $quantity = 1)
    {
        $productData = [
            "id" => $product->product->id,
            "name" => $product->product->name,
            "image" => url('/storage/' . $product->product->primary_image),
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
        return $this->calculateCartPrice($productData);
    }

    private function appendToCart($variantId, $product)
    {
        $productQuantity = $this->sessionService->get(self::CART_SESSION_KEY . "." . $variantId)['quantity'] + 1;
        $this->sessionService->add(self::CART_SESSION_KEY . "." . $variantId, $this->generateProductData($product, $productQuantity));
    }

    public function getCartItems()
    {
        return $this->sessionService->get(self::CART_SESSION_KEY);
    }

    public function calculateCartPrice($item)
    {
        $totalPrice = 0;
        if (isset($item['sale_price'])) {
            $totalPrice += $item['sale_price'] * $item['quantity'];
        } else {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        $item['totalPrice'] = $totalPrice;
        return $item;
    }

    public function calculateTotalCartPrice()
    {
        $cartItems = $this->getCartItems();
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            if (isset($item['sale_price'])) {
                $totalPrice += $item['sale_price'] * $item['quantity'];
            } else {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }
        return $totalPrice;
    }

    public function clear()
    {
        $this->sessionService->clear(self::CART_SESSION_KEY);
    }

    public function increaseQuantity($variation)
    {
        $cartItem = $this->sessionService->get(self::CART_SESSION_KEY . '.' . $variation->id);

        if (!$cartItem) {
            return self::PRODUCT_IS_NOT_EXISTS;
        }

        if ($cartItem['quantity'] >= $variation->quantity) {
            return self::NOT_ENOUGH_STOCK;
        }

        $item = $this->sessionService->increase(self::CART_SESSION_KEY . '.' . $variation->id);

        $calculateProductPrice = $this->calculateCartPrice($item);
        $this->sessionService->add(self::CART_SESSION_KEY . '.' . $variation->id, $calculateProductPrice);

        $this->sessionService->add('totalCartPrice', $this->calculateTotalCartPrice());
        return $variation;
    }
}
