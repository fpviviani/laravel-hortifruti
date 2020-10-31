<!-- Price Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control money-mask']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', 'Stock:') !!}
    {!! Form::number('stock', null, ['class' => 'form-control']) !!}
</div>

{{-- Photo Field --}}
<div class="form-group col-md-12">
    {!! Form::label('photo', \Lang::get('attributes.photo').':') !!}
    @if(isset($product) && !$product->isPhotoDefault())
        <!-- Div needed to restrict link to img -->
        <div style="width:10%">
            <a href="{!! $product->photo !!}" target="_blank">
                <img class="thumbnail" src="{!! $product->photo !!}"/>
            </a>
        </div>
        <!-- Delete img -->
        <div class="form-group col-md-12 no-padding" style="margin-bottom:10px">
            <div class="icheck">
                <label>
                    {!! Form::checkbox('photo', 'delete', false) !!}
                    <span>{!! \Lang::get('attributes.delete_img') !!}</span>
                </label>
            </div>
        </div>
    @else
        <img src=""/>
    @endif
    {!! Form::file('photo', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('products.index') }}" class="btn btn-default">Cancel</a>
</div>