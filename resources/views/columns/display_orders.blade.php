<div>
    <span class="text-muted">Активные заказы:</span> 
    <a href="{{ route('platform.orders', ['display_id' => $display->id, 'active' => true]) }}">{{ $display->activeOrders->count() }}</a>
</div>
<div>
    <span class="text-muted">Всего заказов:</span> 
    <a href="{{ route('platform.orders', ['display_id' => $display->id]) }}">{{ $display->orders->count() }}</a>
</div>