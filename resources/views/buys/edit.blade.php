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
                   {!! Form::model($buy, ['route' => ['buys.update', $buy->id], 'method' => 'patch']) !!}

                        @include('buys.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection