<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = CartItem::with('product')
            ->where('session_id', session()->getId())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        $total = $items->sum(fn($i) => $i->quantity * ($i->product->discount_price ?? $i->product->price));

        return view('frontend.checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
            'city'    => 'required|string|max:100',
        ]);

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Sipariş vermek için giriş yapmalısınız.');
        }

        $items = CartItem::with('product')
            ->where('session_id', session()->getId())
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        $total = $items->sum(fn($i) => $i->quantity * ($i->product->discount_price ?? $i->product->price));

        $order = Order::create([
            'user_id'      => Auth::id(),
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'total_price'  => $total,
            'status'       => 'new',
            'name'         => $request->name,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'city'         => $request->city,
            'note'         => $request->note,
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $item->product->discount_price ?? $item->product->price,
            ]);
        }

        CartItem::where('session_id', session()->getId())->delete();

        return redirect()->route('home')->with('success', 'Siparişiniz alındı! Sipariş no: ' . $order->order_number);
    }
}
