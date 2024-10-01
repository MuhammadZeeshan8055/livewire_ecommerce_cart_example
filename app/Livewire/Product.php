<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class Product extends Component
{
    public $students;
    public $product_id;
    public $quantity = 1;
    public $minPrice;
    public $maxPrice;

    public $selectedColor = [];

    public function mount()
    {
        // $this->students = Products::all();
        $this->loadProducts();
    }
    public function filterProducts()
    {
        $this->loadProducts(); // Reload products with the applied filters
    }
    protected function loadProducts()
    {
        $query = Products::query();

        // Apply price filter if provided
        if ($this->minPrice && $this->maxPrice) {
            $query->whereBetween('price', [$this->minPrice, $this->maxPrice]);
        }

        // You can add more filters here
        
        $this->students = $query->get(); // Fetch filtered products
    }

    // public function addToCart($productId)
    // {
    //     $product = Products::find($productId);
    
    //     if (!$product) {
    //         session()->flash('error', 'Product not found.');
    //         return;
    //     }
    
    //     $cart = Session::get('cart', []);
    
    //     // Check if the product already exists in the cart
    //     if (isset($cart[$productId])) {
    //         $cart[$productId]['quantity'] += $this->quantity;
    //     } else {
    //         $cart[$productId] = [
    //             'name' => $product->name,
    //             'price' => $product->price,
    //             'quantity' => $this->quantity,
    //         ];
    //     }
    
    //     // Update the session with the new cart data
    //     Session::put('cart', $cart);
    
    //     session()->flash('success', 'Product added to cart.');
    // }

    public function addToCart($productId)
    {
        $product = Products::find($productId);

        if (!$product) {
            session()->flash('error', 'Product not found.');
            return;
        }

        $cart = Session::get('cart', []);

        // Get the selected color for the product
        $selectedColor = $this->selectedColor[$productId] ?? null;

        if (!$selectedColor) {
            session()->flash('error', 'Please select a color.');
            return;
        }

        $itemExists = false;

        // Check if the product with the same color exists in the cart
        foreach ($cart as $key => $item) {
            if ($item['id'] == $productId && $item['color'] == $selectedColor) {
                $cart[$key]['quantity'] += $this->quantity;
                $itemExists = true;
                break;
            }
        }

        // If the product with the selected color doesn't exist in the cart, add it as a new item
        if (!$itemExists) {
            $cart[] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $this->quantity,
                'color' => $selectedColor,  // Add the selected color
            ];
        }

        // Update the session with the new cart data
        Session::put('cart', $cart);

        session()->flash('success', 'Product added to cart.');
    }


    
    public function getCartContent()
    {
        return Session::get('cart', []);
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
        return view('livewire.product');
    }
}
