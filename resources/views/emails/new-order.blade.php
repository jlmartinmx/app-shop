<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo pedido</title>
</head>
<body>
    <p>Se ha realizado un nuevo pedido!</p>
    <p>Estos son los datos del cliente que realizo el pedido:</p>
    <ul>
        <li>
            <strong>Nombre:</strong>
            {{ $user->name }}
        </li>
        <li>
            <strong>E-mail:</strong>
            {{ $user->email }}
        </li>
        <li>
            <strong>Fecha del pedido:</strong>
            {{ $cart->order_date }}
        </li>
    </ul>

    <hr>
    <!-- 71 0:0 -->
    <p>Y estos son los detalles del pedido:</p>

    <ul>
        @foreach($cart->details as $detail)
            <li>
                {{ $detail->product->name }} x{{ $detail->quantity }}
                ($ {{ $detail->quantity * $detail->product->price }})
            </li>
        @endforeach
    </ul>

    <p>
        <strong>Importe que el cliente debe pagar: </strong> {{ $cart->total }} 
    </p>
    <hr>

    <p>
        <!-- link para listar la orden pendiente -->
        <a href="{{ url('/admin/orders/'.$cart->id) }}">Haz click aqui</a>
        para ver mas informacion sobre este pedido.
    </p>
</body>
</html>