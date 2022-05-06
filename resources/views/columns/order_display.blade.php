<div style="white-space: normal; word-break: break-word; min-width:200px">
    @foreach($order?->displays as $display)
        <div class="bg-primary bg-gradient border p-1 rounded mr-1" style="display:inline-block">
            {{ $display->title }} ({{ $display?->city->title }})
        </div>
    @endforeach
</div>
<div>
    <span class="text-muted">Видео: </span>
    {{ $order?->video?->title }}
    @if($order?->video?->duration)
        <span class="text-muted">({{ $order?->video?->duration }} секунд)</span>
    @endif
</div>