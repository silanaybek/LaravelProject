<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function sessionId()
    {
        return session()->getId();
    }

    public function index()
    {
        $items = CartItem::with('product')
            ->where('session_id', $this->sessionId())
            ->get();

        $total = $items->sum(fn($i) => $i->quantity * ($i->product->discount_price ?? $i->product->price));

        return view('frontend.cart', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);

        $product = Product::findOrFail($request->product_id);

        if ($product->sizes && count($product->sizes) > 0 && !$request->size) {
            return back()->with('error', 'Lütfen bir beden seçin.');
        }

        $item = CartItem::firstOrCreate(
            [
                'session_id' => $this->sessionId(),
                'product_id' => $product->id,
                'size'       => $request->size ?? null,
            ],
            ['quantity' => 0]
        );

        $item->increment('quantity', $request->input('quantity', 1));

        $sizeLabel = $request->size ? ' (Beden: ' . $request->size . ')' : '';
        return back()->with('success', $product->name . $sizeLabel . ' sepete eklendi.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $cartItem->update(['quantity' => $request->quantity]);
        return back()->with('success', 'Sepet güncellendi.');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return back()->with('success', 'Ürün sepetten çıkarıldı.');
    }

    public function clear()
    {
        CartItem::where('session_id', $this->sessionId())->delete();
        return back()->with('success', 'Sepet temizlendi.');
    }
}
