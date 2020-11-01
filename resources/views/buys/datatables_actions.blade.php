<div class='btn-group'>
    <a href="{{ route('buys.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @if($is_delivered == false)
        <a href="{{ route('buys.deliver', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-check"></i>
        </a>
    @endif
</div>
