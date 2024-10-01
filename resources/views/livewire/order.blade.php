<div>
    @foreach($orders as $orderData)
        <h2>Order ID: {{ $orderData['order_id'] }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Product Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderData['order_values'] as $order)
                    <tr>
                        <td>{{ $order['product_name'] }}</td>
                        <td>{{ $order['quantity'] }}</td>
                        <td>{{ $order['product_price'] }}</td>
                        <td>{{ $order['total'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</div>
