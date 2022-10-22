<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RedirectHelper;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\CompleteCartRequest;
use App\Http\Requests\Cart\RemoveFromCartRequest;
use App\Http\Services\Cart\CartService;
use App\Http\Resources\Cart\CartResource;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    /**
     * Cart Service
     * @var CartService
     */
    private $cartService;

    /**
     * Cart Controller Constructor
     * @param CartService $_cartService
     */
    public function __construct(CartService $_cartService)
    {
        $this->cartService = $_cartService;
    }

    /**
     * Cart Controller List
     * @param $id
     * @return JsonResponse
     */
    public function list($id): JsonResponse
    {
        return RedirectHelper::customSuccess([
            'cart' => new CartResource($this->cartService->list($id))
        ]);
    }

    /**
     * Cart Controller Add To Cart
     * @param AddToCartRequest $request
     * @return JsonResponse
     */
    public function addToCart(AddToCartRequest $request): JsonResponse
    {
        $cart = $this->cartService->addToCart($request->validated());

        if($cart) {
            return RedirectHelper::customSuccess([
                'cart' => new CartResource($this->cartService->list($cart->cart_id))
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Cart Controller Remove From Cart
     * @param RemoveFromCartRequest $request
     * @return JsonResponse
     */
    public function removeFromCart(RemoveFromCartRequest $request): JsonResponse
    {
        $cartId = $this->cartService->removeFromCart($request->validated());

        if($cartId) {
            return RedirectHelper::customSuccess([
                'cart' => new CartResource($this->cartService->list($cartId))
            ]);
        }

        return RedirectHelper::error();
    }

    /**
     * Cart Controller Complete
     * @param CompleteCartRequest $request
     * @return JsonResponse
     */
    public function complete(CompleteCartRequest $request): JsonResponse
    {
        $cartId = $this->cartService->complete($request->validated());

        if($cartId) {
            return RedirectHelper::customSuccess([
                'cart' => new CartResource($this->cartService->list($cartId))
            ]);
        }

        return RedirectHelper::error();
    }
}