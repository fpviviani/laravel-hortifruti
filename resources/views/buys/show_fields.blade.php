<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', \Lang::get('attributes.cliente').':') !!}
    <p>{{ $buy->user_id }}</p>
</div>

<!-- Total Value Field -->
<div class="form-group">
    {!! Form::label('total_value', \Lang::get('attributes.total_value').':') !!}
    <p>R${{str_replace(".", ",", $buy->total_value)}}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', \Lang::get('attributes.date').':') !!}
    <p>{{ $buy->readable_date }}</p>
</div>

@foreach($buy->products as $product)
<div class="row">
    <div class="col-md-6">
        <!-- Date Field -->
        <div class="form-group">
            {!! Form::label('date', 'Produto:') !!}
            <p>{{ $product->name }}</p>
        </div>
    </div>
    <div class="col-md-6">
        <!-- Date Field -->
        <div class="form-group">
            {!! Form::label('date', 'Quantidade:') !!}
            <p>{{ $product->pivot->product_quantity }}</p>
        </div>
    </div>
</div>
@endforeach