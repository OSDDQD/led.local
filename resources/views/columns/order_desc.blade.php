<div><span class="text-muted">Статус оплаты:</span> 
    @if($order->status)
        <i class="text-success circle">{{ $order::STATUS[$order->status] }}</i>
    @else
        <i class="text-danger circle">{{ $order::STATUS[$order->status] }}</i>
    @endif
<div><span class="text-muted">Тип заказа:</span> {{ $order::ORDER_TYPE[$order->order_type] }}<div>
