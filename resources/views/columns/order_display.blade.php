<div style="white-space: normal;">
    @foreach($order?->displays as $display)
        {{ $display->title }} <span class="text-muted">({{ $display?->city->title }})</span>
    @endforeach
</div>
<div><span class="text-muted">Видео: </span>{{ $order?->video?->title }}</div>