@extends('Index')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">
                <div class="breadcrumb col-lg-4 col-md-4">

                    <a href="{{ route('wedstrijdindex') }}"><- ga terug</a>

                    <br>
                    <br>


                </div>
                <div class="clearfix "></div>
                @include("feedback.session")
                @include("feedback.error")


                <section class="wedstrijd">


                    <h2 class="text-center">Wedstrijd nr: {{ $wedstrijdId }} aanpassen</h2>
                    {!! Form::model(array('route' => 'editwedstrijd','class' => 'form-horizontal',$wedstrijdId)) !!}
                    {{ csrf_field() }}

                    <div class="form-group inputss">
                        {!! Form::label('name', 'WedstrijdNaam',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::text('name', null, ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    <div class="form-group inputss">
                        {!! Form::label('duur', 'Hoeveel dagen duurt elke wedstrijd?',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::number('duur', null, ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    <div class="form-group inputss">
                        {!! Form::label('start_date', 'Startdatum',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::date('start_date', null, ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    <div class="form-group inputss">
                        {!! Form::label('end_date', 'Einddatum',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::date('end_date', null, ['class' => 'form-control inputsField']) !!}
                        </div>
                    </div>
                    <div class="form-group inputss">
                        {!! Form::label('is_active', 'Actief',['class'=> 'col-md-5 control-label controle'])  !!}
                        <div class="col-md-7 ">
                            {!! Form::select('is_active', array('1' => 'Ja', '0' => 'Nee'), '1', ['class' => 'form-control inputsField']) !!}
                            {{--{!! Form::number('is_active', null) !!}--}}
                        </div>
                    </div>


                    <div class="form-group">
                        {{ Form::submit('submit', array('class' => 'btn btnLarge')) }}
                    </div>


                    {!! Form::close() !!}

                </section>


            </div>
        </div>
    </div>
@endsection