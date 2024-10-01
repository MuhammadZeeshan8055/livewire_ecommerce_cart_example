<?php

namespace App\Livewire;

use App\Models\Test;
use Livewire\Component;

class Order extends Component
{
    public $orders;

    public function mount()
    {
        // Fetch all records from the 'tests' table
        $testData = Test::all(); // Retrieve all records
        $this->orders = $testData->map(function ($test) {
            return [
                'order_id' => $test->orderId, // Adjust as needed
                'order_values' => json_decode($test->order_values, true)
            ];
        });
    }


    public function render()
    {
        return view('livewire.order');
    }
}

