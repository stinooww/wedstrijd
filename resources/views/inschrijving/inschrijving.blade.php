@extends('Index')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-9 col-md-3 col-md-9 col-sm-12">
                {!! Form::open(array('url'=>'inschrijvings/store','method'=> 'POST', 'id'=>'formInschrijving')) !!}
                <div class="breadcrumb col-lg-4 col-md-4">

                    <a href="{{ route('homepage') }}"><- ga terug</a>

                </div>
                <div class="clearfix "></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                @endif
                {{ Form::hidden('wedstrijdId', Crypt::encrypt($wedstrijdId)) }}
                {{ csrf_field() }}
                <div class="form-group inputss">
                    {!! Form::label('firstname', 'Voornaam',['class'=> 'col-md-5 control-label'])  !!}
                    <div class="col-md-7 ">
                        {!! Form::text('firstname', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('lastname', 'Achternaam',['class'=> 'col-md-5 control-label'])  !!}
                    <div class="col-md-7 ">
                        {!! Form::text('lastname', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('street', 'Straatnaam',['class'=> 'col-md-5 control-label'])  !!}
                    <div class="col-md-7 ">
                        {!! Form::text('street', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('streetnumber', 'Straat nummer',['class'=> 'col-md-5 control-label'])  !!}
                    <div class="col-md-7 ">
                        {!! Form::number('streetnumber', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('gemeente', 'Gemeente',['class'=> 'col-md-5 control-label'])  !!}
                    <div class="col-md-7 ">
                        {!! Form::text('gemeente', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('email', 'Uw emailadres',['class'=> 'col-md-5 control-label']) !!}
                    <div class="col-md-7">
                        {!! Form::email('email', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('vraag', 'Hoeveel 25cl pintjes geraken er in 5meter?',['class'=> 'col-md-5 control-label']) !!}
                    <div class="col-md-7 inputss">
                        {!! Form::number('vraag', null, ['class' => 'form-control inputsField']) !!}
                    </div>
                </div>
                {{--<div class="form-group inputss">--}}
                {{--{!! Form::label('foto', 'foto',['class'=> 'col-md-4 control-label']) !!}--}}
                {{--<div class="col-md-5 inputss">--}}
                {{--{!! Form::file('foto') !!}--}}
                {{--</div>--}}
                {{--</div>--}}

                <div class="form-group ">
                    <div class="col-md-offset-5 col-md-5" id="submitBtn">
                        {!! Form::submit('Win 5 Meter bier',['class'=>'btn btnLarge form-control btnSubmit', 'id'=>'btnSubmit']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>



@endsection
