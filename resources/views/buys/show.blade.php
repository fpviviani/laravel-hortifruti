@extends('layouts.app')

@section('content')
    <section class="content-header">
    <h1 class="title-header">{!! \Lang::choice("tables.buys", "s") !!}</h1>

    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('buys.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
