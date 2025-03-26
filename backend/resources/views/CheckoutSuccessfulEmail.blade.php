<!DOCTYPE html>
<html>

<head>
    <title>Checkout Successful</title>
</head>

<body>
    <h1>Your Order Was Successful!</h1>

    <p>Dear {{ $customerName }},</p>

    <p>Your order ID is: <strong>{{ $orderId }}</strong></p>

    <p>Total Amount: ${{ $totalAmount }}</p>

    <p>Shipping Address:</p>
    <address>
        {{ $address }} {{ $city }} {{ $state }} {{ $zip }}
    </address>

    @if (!empty($items))
    <h2>Order Items:</h2>
    <ul>
        @foreach ($items as $item)
        <li>{{ $item['product_name'] }} - ${{ number_format($item['product_price'], 2) }} | Qty: {{ $item['quantity']}} | Subtotal: {{ $item['subtotal']}}</li>
        @endforeach
    </ul>
    @endif

    <p>{{ $thankYouMessage }}</p>

    <p>Thank you for your business!</p>
</body>

</html>