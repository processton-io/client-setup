<?php

namespace Processton\Cart\Controllers\Api;

use App\Models\User;
use Processton\Cart\Controllers\Controller;
use Processton\Customer\Models\CustomerContact;

class ApiController extends Controller
{

    public function initialize(){

        $cart = \Processton\Cart\Models\Cart::create([
            'user_id' => auth()->id() ?? null,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Cart initialized successfully',
            'data' => $cart,
        ]);
    }

    public function show($cartId)
    {
        $cart = \Processton\Cart\Models\Cart::with('items')->findOrFail($cartId);

        return response()->json([
            'status' => 'success',
            'data' => [
                'id' => $cart->id,
                'user_id' => $cart->user_id,
                'items' => $cart->items->map(function ($item) {
                    return [
                        'id' => $item->item_id,
                        'name' => $item->item->entity->name,
                        'quantity' => $item->quantity,
                        'price' => $item->item->price,
                        'total' => $item->quantity * $item->item->price,
                    ];
                })->toArray(),
            ],
        ]);
    }

    public function searchItems($cartId)
    {
        $query = request()->input('q', '');

        if (empty($query)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Search query cannot be empty',
            ], 400);
        }

        $cart = \Processton\Cart\Models\Cart::findOrFail($cartId);

        //Join items with products services asset and subscriptions and search across them


        $products = \Processton\Items\Models\Product::where('name', 'like', '%' . $query . '%')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $products->map(function ($product) {
                return [
                    'id' => $product->item->id,
                    'name' => $product->name,
                    'price' => $product->item->price,
                    'type' => 'product',
                ];
            })->toArray()
        ]);
    }

    public function addItem($cartId)
    {
        $data = request()->validate([
            'product_id' => 'required|uuid|exists:items,id',
            'quantity' => 'required|integer|min:1',
        ]);
        
        $itemId = $data['product_id'];
        $quantity = $data['quantity'];

        $cart = \Processton\Cart\Models\Cart::findOrFail($cartId);

        $item = \Processton\Items\Models\Item::find($itemId);

        $cartItem = \Processton\Cart\Models\CartItem::where('cart_id', $cart->id)
            ->where('item_id', $itemId)
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
        } else {
            $cartItem = \Processton\Cart\Models\CartItem::create([
                'cart_id' => $cart->id,
                'item_id' => $itemId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Item added to cart successfully',
            'data' => $cartItem,
        ]);
    }

    public function removeItem($cartId, $itemId)
    {
        $cart = \Processton\Cart\Models\Cart::findOrFail($cartId);

        $item = \Processton\Cart\Models\CartItem::where('cart_id', $cartId)
            ->where('item_id', $itemId)
            ->first();

        if ($item) {
            $item->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart successfully',
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Item not found in cart',
        ], 404);
    }

}
