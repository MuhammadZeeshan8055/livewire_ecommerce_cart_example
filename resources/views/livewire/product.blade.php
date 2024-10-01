<div>

    <a href="{{ route('cart') }}">Cart</a>
    <br>
    <br>
    {{-- <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($students as $student)
                <tr>
                    <td>{{$student->id}}</td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->price}}</td>
                    
                    <td>
                        <button wire:click="addToCart({{$student->id}})">Add To Cart</button>
                    </td>
                </tr>
            @endforeach
        
        </tbody>
    </table> --}}
    <input type="number" wire:model="minPrice" placeholder="Min Price">
    <input type="number" wire:model="maxPrice" placeholder="Max Price">

    <button wire:click="filterProducts">Filter</button>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>Color</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->price }}</td>
                    
                    <td>
                        <select wire:model="selectedColor.{{ $student->id }}">
                            <option value="">Select Color</option> <!-- Ensure default option exists -->
                            <option value="red">Red</option>
                            <option value="green">Green</option>
                        </select>
                    </td>
                    
                    <td>
                        <button wire:click="addToCart({{ $student->id }})">Add To Cart</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

    @if(session()->has('success'))
        <p style="color:green">{{session('success')}}</p>
    @endif


    <h3>Cart Items</h3>

    @foreach($this->getCartContent() as $item)
        <div>
            <p>{{ $item['name'] }} - Quantity: {{ $item['quantity'] }} - Price: ${{ $item['price'] }} - Color: {{ $item['color'] }}</p>
        </div>
    @endforeach


    
    <h4>Cart Total: ${{ $this->getCartTotal() }}</h4>


</div>
