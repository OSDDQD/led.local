<div>
    <span class="text-muted">Длительность ролика:</span> {{ $video->duration }} секунд
</div>
<div>
    <span class="text-muted">Используется в заказах:</span> 
    <a href="{{ route('platform.orders', ['video_id' => $video->id]) }}">{{ $video->orders->count() }}</a>
</div>