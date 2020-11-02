<div class='btn-group'>
    <a href="{{ route('buys.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
    @if($is_delivered == false)
        <a href="{{ route('buys.deliver', $id) }}"  title="Confirmar Entrega" onclick="return confirm_click();" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-check"></i>
        </a>
    @endif
</div>

<script type="text/javascript">
    function confirm_click(){
        return confirm("Deseja confirmar a entrega?");
    }
</script>
