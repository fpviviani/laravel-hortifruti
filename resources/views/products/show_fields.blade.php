<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $product->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $product->name }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $product->price }}</p>
</div>

<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', 'Stock:') !!}
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

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $product->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $product->updated_at }}</p>
</div>

