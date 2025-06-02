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
            'data' => $cart,
        ]);
    }

    public function searchItems($cartId)
    {
        $query = request()->input('q', '');
        
        $cart = \Processton\Cart\Models\Cart::findOrFail($cartId);

        $items = $cart->items()
            ->where('name', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->get();

        return response()->json([
            'status' => 'success',
            'data' => $items,
        ]);
    }

    public function addItem($cartId, $itemId, $quantity = 1)
    {
        $cart = \Processton\Cart\Models\Cart::findOrFail($cartId);

        $item = \Processton\Cart\Models\CartItem::where('cart_id', $cartId)
            ->where('item_id', $itemId)
            ->first();

        if ($item) {
            $item->increment('quantity', $quantity);
        } else {
            $item = \Processton\Cart\Models\CartItem::create([
                'cart_id' => $cartId,
                'item_id' => $itemId,
                'quantity' => $quantity,
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Item added to cart successfully',
            'data' => $item,
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
