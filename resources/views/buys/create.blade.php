@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Buy
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'buys.store']) !!}

                        @include('buys.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
