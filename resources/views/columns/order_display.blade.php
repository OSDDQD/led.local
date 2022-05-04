<div style="white-space: normal; word-break: break-word; min-width:200px">
    @foreach($order?->displays as $display)
        {{ $display->title }} <span class="text-muted">({{ $display?->city->title }})</span>
    @endforeach
</div>
<div><span class="text-muted">Видео: </span>{{ $order?->video?->title }}</div>