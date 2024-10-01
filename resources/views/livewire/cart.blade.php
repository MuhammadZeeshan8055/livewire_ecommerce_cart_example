<div>
    <h3>Cart Items</h3>

    {{-- @foreach($this->getCartContent() as $productId => $item)
        <div>
            <p>{{ $item['name'] }} - Quantity: {{ $item['quantity'] }} - Price: ${{ $item['price'] * $item['quantity'] }}</p>
            <button wire:click="decrement('{{ $productId }}')">-</button>
            <button wire:click="increment('{{ $productId }}')">+</button>
        </div>
    @endforeach --}}

    <a href="{{ route('product') }}">Shop</a>
    <br>
    <br>

    <table>
        <thead>
            <tr>
                <th>Remove</th>
                <th>Id</th>
                <th>Name</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>

            @foreach($this->getCartContent() as $productId => $item)
                <tr>
                    <td>
                        <button wire:click="removeFromCart({{$productId}})">x</button>
                    </td>

                    <td>{{$productId}}</td>
                    <td>{{$item['name']}}</td>
                    <td>{{$item['color']}}</td>
                    <td><button wire:click="decrement('{{ $productId }}')">-</button>{{$item['quantity']}}<button wire:click="increment('{{ $productId }}')">+</button></td>
                    <td>{{$item['price']}}</td>
                    
                   
                </tr>
            @endforeach
        
        </tbody>
    </table>
    

    <h4>Cart Total: ${{ $this->getCartTotal() }}</h4>

    <button wire:click="orderNow">Order Now</button>

    @if(session()->has('success'))
        <p style="color:green">{{session('success')}}</p>
    @endif

</div>
