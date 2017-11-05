@extends('Index')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">
                <div class="breadcrumb col-lg-4 col-md-4">

                    <a href="{{ route('adminindex') }}"><- ga terug</a>

                    <br>
                    <br>


                </div>
                @include("feedback.session")
                @include("feedback.error")

                <div class="clearfix "></div>

                <section class="wedstrijd">


                    <h2 class="text-center">Admin nr: {{ $id }} aanpassen</h2>

                    {!! Form::model(array('route' => 'editwedstrijd','class' => 'form-horizontal',$id)) !!}
                    {{ csrf_field() }}
                    {{ method_field('POST') }}
                    <div class="form-group inputss">
                        {!! Form::label('name', 'Admin name',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::text('name', null, ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    <div class="form-group inputss">
                        {!! Form::label('email', 'Email',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::text('email', null, ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    <div class="form-group inputss">
                        {!! Form::label('role_id', 'Role',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {{--{!! Form::date('role_id', null, ['class' => 'form-control inputsField']) !!}--}}
                            {!! Form::select('role_id', array('1' => 'User', '2' => 'Admin'), '2', ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    {{--<div class="form-group inputss">--}}
                    {{--{!! Form::label('is_active', 'Actief',['class'=> 'col-md-5 control-label controle'])  !!}--}}
                    {{--<div class="col-md-7 ">--}}
                    {{--{!! Form::select('is_active', array('1' => 'Ja', '0' => 'Nee'), '1', ['class' => 'form-control inputsField']) !!}--}}
                    {{--{!! Form::number('is_active', null) !!}--}}
                    {{--</div>--}}
                    {{--</div>--}}


                    <div class="form-group">
                        {{ Form::submit('submit', array('class' => 'btn btnLarge')) }}
                    </div>


                    {!! Form::close() !!}

                </section>


            </div>
        </div>
    </div>




@endsection