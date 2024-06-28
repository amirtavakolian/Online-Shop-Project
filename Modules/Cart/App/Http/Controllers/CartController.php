<?php

namespace Modules\Cart\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Cart\App\Services\Cart\SessionCartService;

class CartController extends Controller
{

    public function __construct(private SessionCartService $cartService)
    {

    }

    public function add(Request $request)
    {
        $addToCartResult = $this->cartService->add($request->input('variant_id'));

        if ($addToCartResult === SessionCartService::NOT_ENOUGH_STOCK) {
            $response = $this->createResponse(SessionCartService::NOT_ENOUGH_STOCK, 400);
        }

        if ($addToCartResult === SessionCartService::PRODUCT_IS_NOT_EXISTS) {
            $response = $this->createResponse(SessionCartService::PRODUCT_IS_NOT_EXISTS, 400);
        }

        if ($addToCartResult !== SessionCartService::PRODUCT_IS_NOT_EXISTS && $addToCartResult !== SessionCartService::NOT_ENOUGH_STOCK) {
            $response = $this->createResponse("محصول با موفقیت به سبد خرید اضافه شد", 200, $addToCartResult);
        }

        return response()->json($response);
    }

    private function createResponse($message, $status, $data = "")
    {
        $response = [];
        $response['message'] = $message;
        $response['status'] = $status;
        $response['data'] = $data;
        return $response;
    }

    public function getCartItems()
    {
        return response()->json([
            "data" => $this->cartService->getCartItems(),
            "status" => 200
        ]);
    }

    public function index()
    {
        $cartItems = $this->cartService->getCartItems();
        $cartItemsPrice = $this->cartService->calculateCartPrice();
        return view('cart::index', compact('cartItems', 'cartItemsPrice'));
    }

    }
}
