<div>
    <span class="text-muted">Заказов:</span> 
    <a href="{{ route('platform.orders', ['customer_id' => $customer->id]) }}">{{ $customer->orders()->count() }}</a>
</div>
<div>
    <span class="text-muted">Роликов:</span> 
    <a href="{{ route('platform.videos', ['customer_id' => $customer->id]) }}">{{ $customer->videos()->count() }}</a>
</div>