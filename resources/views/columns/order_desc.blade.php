@if($order->price)
    <div><span class="text-muted">Стоимость:</span> {{ number_format($order->price) }}<div>
@endif
<div><span class="text-muted">Статус оплаты:</span> 
    @if($order->status == 1)
        <i class="text-success circle">{{ $order::STATUS[$order->status] }}</i>
    @elseif($order->status == 2)
        <i class="text-danger circle">
            {{ $order::STATUS[$order->status] }} 
            @if(isset($order::MONTH_RANGE[$order->payed_for]))
                <strong>{{ $order::MONTH_RANGE[$order->payed_for] }}</strong>
            @endif
        </i>
    @else
        <i class="text-danger circle">{{ $order::STATUS[$order->status] }}</i>
    @endif
<div><span class="text-muted">Тип заказа:</span> {{ $order::ORDER_TYPE[$order->order_type] }}<div>
