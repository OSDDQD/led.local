<div>{{ $display->title }} 
    @if($display->is_active)
        <i class="text-success circle">● активен</i>
    @else
        <i class="text-danger circle">● не активен</i>
    @endif
</div> 
<div class="text-muted">{{ $display->description }}</div>