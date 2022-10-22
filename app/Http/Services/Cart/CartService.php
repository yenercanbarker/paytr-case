<?php

namespace App\Http\Services\Cart;

use App\Http\Enumerations\CartStatusEnum;
use App\Http\Facades\FacadeClasses\PriceCalculator;
use App\Http\Interfaces\Cart\CartInterface;
use App\Http\Interfaces\CartProduct\CartProductInterface;
use App\Http\Resources\Admin\Product\ProductCartResource;
use Illuminate\Support\Facades\DB;

class CartService
{
    /**
     * Cart Repository Instance
     * @var CartInterface
     */
    private $cartRepository;

    /**
     * Cart Product Repository Instance
     * @var CartProductInterface
     */
    private $cartProductRepository;

    /**
     * Cart Service Construct
     * @param CartInterface $_cartRepository
     * @param CartProductInterface $_cartProductRepository
     */
    public function __construct(CartInterface $_cartRepository, CartProductInterface $_cartProductRepository)
    {
        $this->cartRepository = $_cartRepository;
        $this->cartProductRepository = $_cartProductRepository;
    }

    /**
     * Cart Service Add to Cart
     * @param $request
     * @return mixed
     */
    public function addToCart($request): mixed
    {
        return DB::transaction(function () use ($request) {
            $isUserHasNotCompletedCart = $this->cartRepository
                ->isUserHasNotCompletedCart();

            if($isUserHasNotCompletedCart) {
                $request['cart_id'] = $isUserHasNotCompletedCart->id;
            } else {
                $cart = $this->cartRepository
                    ->store([
                        'user_id' => auth()->user()->id,
                        'status' => CartStatusEnum::NOT_COMPLETED
                    ]);

                if($cart) {
                    $request['cart_id'] = $cart->id;
                }
            }

            return $this->cartProductRepository->updateOrCreate($request);
        });
    }

    /**
     * Cart Service Remove From Cart
     * @param $request
     * @return mixed
     */
    public function removeFromCart($request): mixed
    {
        $isUserHasNotCompletedCart = $this->cartRepository
            ->isUserHasNotCompletedCart();

        if($isUserHasNotCompletedCart) {
            $request['cart_id'] = $isUserHasNotCompletedCart->id;
            
            $this->cartProductRepository->delete($request);

            return $isUserHasNotCompletedCart->id;
        }

        return false;
    }

    /**
     * Cart Service List
     * @param $id
     * @return array
     */
    public function list($id): array
    {
        $formattedProducts = [];
        $cart = $this->cartRepository->list($id);

        $formattedCart = [
            'id' => $cart->id,
            'status' => ($cart->status == CartStatusEnum::NOT_COMPLETED) ? 'Not Completed' : 'Completed',
            'created_at' => $cart->created_at,
            'updated_at' => $cart->updated_at,
        ];

        if(isset($cart->cartProducts) && !empty($cart->cartProducts)) {
            $formattedCart['total_price_without_discount'] = 0;
            $formattedCart['discount_price'] = 0;
            $formattedCart['total_price'] = 0;
            foreach ($cart->cartProducts as $product) {
                $productVariant = $product->products->first();
                $product->total_price_without_discount = PriceCalculator::calculateTotalPriceWithoutDiscounts($productVariant['price'], $product['count'], $productVariant['discount_percent']);
                $product->discount_price = PriceCalculator::calculateDiscountPrice($productVariant['price'], $product['count'], $productVariant['discount_percent']);
                $product->total_price = PriceCalculator::calculateTotalPrice($productVariant['price'], $product['count'], $productVariant['discount_percent']);
                $formattedProducts[] = new ProductCartResource($product);

                $formattedCart['products'] = $formattedProducts;
                $formattedCart['total_price_without_discount'] += $product->total_price_without_discount;
                $formattedCart['discount_price'] += $product->discount_price;
                $formattedCart['total_price'] += $product->total_price;
            }

            return $formattedCart;
        }

        return $formattedCart;
    }

    /**
     * Cart Service Complete
     * @param $request
     * @return mixed
     */
    public function complete($request): mixed
    {
        $isUserHasNotCompletedCart = $this->cartRepository
            ->isUserHasNotCompletedCart();

        if($isUserHasNotCompletedCart) {
            $id = $isUserHasNotCompletedCart->id;

            if($request['status'] === "paid") {
                $request['status'] = CartStatusEnum::COMPLETED;

                $this->cartRepository->update($request, $id);

                return $id;
            }
        }

        return false;
    }
}