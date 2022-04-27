<div>{{ $order->title }}</div>
<div>
    <span class="text-muted">Заказчик: </span> 
    <a href="{{ route('platform.customers.show', $order->customer) }}">{{ $order?->customer?->title }}</a>
</div>
@if($order->deal_start_at)
    <div><span class="text-muted">Действитен с:</span> {{ $order->deal_start_at }}<div>
@endif
@if($order->deal_end_at)
    <div><span class="text-muted">Действитен по:</span> {{ $order->deal_end_at }}<div>
    @if($order->deal_end_at > now())
        <i class="text-success circle">● активно</i>
    @else
        <i class="text-danger circle">● прошло</i>
    @endif
@endif
@if(!$order->deal_start_at&& !$order->deal_end_at)
    Информация не указана
@endif