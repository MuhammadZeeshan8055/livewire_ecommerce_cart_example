<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use App\Models\Order;


class Cart extends Component
{
    public function getCartContent()
    {
        return Session::get('cart', []);
    }

    public function increment($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            Session::put('cart', $cart);
        }
    }
    public function decrement($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
                Session::put('cart', $cart);
            } else {
                // Optionally, you can remove the item if the quantity is 1
                unset($cart[$productId]);
                Session::put('cart', $cart);
            }
        }
    }

    public function removeFromCart($productId){
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
    }


    public function orderNow()
    {

        
        $lastId = Order::max('id');

        $cart = $this->getCartContent();
        $total = $this->getCartTotal();

        // Generate a unique order ID
        $orderId = 'SP'.($lastId ? $lastId + 1 : 1);

        foreach ($cart as $productId => $item) {
            Order::create([
                'order_id' => $orderId,
                'product_id' => $productId,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'product_price' => $item['price'],
                'total' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear the cart after ordering
        Session::forget('cart');

        // Optionally, you can add a success message
        session()->flash('success', 'Order placed successfully!');
    }   

    public function getCartTotal()
    {
        $cart = $this->getCartContent();
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
