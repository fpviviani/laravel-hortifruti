<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', \Lang::get('attributes.name').':') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', \Lang::get('attributes.price').':') !!}
    <p>{{ $product->price }}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', \Lang::get('attributes.stock').':') !!}
    <p>{{ $product->stock }}</p>
</div>

@if(!$product->isPhotoDefault())
    {{-- Photo Field --}}
    <div class="form-group col-md-12 show-margin-fix">
        {!! Form::label('photo', \Lang::get('attributes.photo').':') !!}
        {{-- Div needed to restrict link to img --}}
        <div style="width:10%">
            <a href="{{ $product->photo }}" target="_blank">
                <img class="thumbnail" src="{{ $product->photo }}"/>
            </a>
        </div>
    </div>
@endif
