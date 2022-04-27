<div>{{ $order->title }}</div>
<div>
    <span class="text-muted">Заказчик: </span> 
    <a href="{{ route('platform.customers.show', $order->customer) }}">{{ $order->customer->title }}</a>
</div>