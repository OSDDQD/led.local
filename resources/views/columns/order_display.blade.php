<div>
    @foreach($order?->displays as $display)
        {{ $display->title }}@if(!$loop->last), @endif
    @endforeach
</div>
<div><span class="text-muted">Видео: </span>{{ $order?->video?->title }}</div>