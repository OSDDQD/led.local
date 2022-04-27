@if($order->start_at)
    <div><span class="text-muted">Начало:</span> {{ $order->start_at }}<div>
@endif
@if($order->end_at)
    <div><span class="text-muted">Окончание:</span> {{ $order->end_at }}<div>
    @if($order->end_at > now())
        <i class="text-success circle">● активно</i>
    @else
        <i class="text-danger circle">● прошло</i>
    @endif
@endif
@if(!$order->start && !$order->end_at)
    Информация не указана
@endif

