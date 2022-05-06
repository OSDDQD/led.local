<a href="{{ route('platform.orders', ['display_id' => $display->id, 'active' => true]) }}" class="rounded bg-primary bg-gradient border p-1 mb-1" style="display:block; color:#fff">
    Активные заказы: {{ $display->activeOrders->count() }}
</a>
<a href="{{ route('platform.orders', ['display_id' => $display->id]) }}" class="rounded bg-secondary bg-gradient border p-1" style="display:block; color:#fff">
    Всего заказов: {{ $display->orders->count() }}
</a>