@extends('Index')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">
                <div class="breadcrumb col-lg-4 col-md-4">

                    <a href="{{ route('deelnemerspagina') }}"><- ga terug</a>

                    <br>
                    <br>


                </div>
                @include("feedback.session")
                @include("feedback.error")

                <div class="clearfix "></div>

                <section class="deelnemer">
                    <h3>Deelnemer aanpassen</h3>


                    {!! Form::open(array(route('editdeelnemer',$deelnemer->id) ,'class' => 'form-horizontal')) !!}
                    <div class="col-md-6">
                        <div class="col-md-6 ">
                            {{ csrf_field() }}
                            <div class="form-group">
                                {{ Form::label('firstname', 'Voornaam', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="firstname"
                                       value="{{$deelnemer->firstname}}">
                            </div>
                            <div class="form-group">
                                {{ Form::label('lastname', 'Achternaam', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="lastname"
                                       value="{{$deelnemer->lastname}}">
                            </div>

                            <div class="form-group">
                                {{ Form::label('email', 'Email', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="email" value="{{$deelnemer->email}}">
                            </div>
                            <div class="form-group ">
                                {!! Form::label('is_deleted', 'Verwijderen',['class'=> 'col-md-5 control-label controle'])  !!}
                                <div class="col-md-12">
                                    {!! Form::select('is_deleted', array('1' => 'Ja', '0' => 'Nee'), '0', ['class' => 'form-control inputsField']) !!}
                                </div>
                            </div>
                            <div class="form-group inputss">
                                {!! Form::label('qualified', 'Disqualificren',['class'=> 'col-md-5 control-label controle'])  !!}
                                <div class="col-md-12 ">
                                    {!! Form::select('qualified', array('1' => 'Ja', '0' => 'Nee'), '0', ['class' => 'form-control inputsField']) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('streetname', 'Straatnaam', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="streetname"
                                       value="{{$deelnemer->streetname}}">
                            </div>
                            <div class="form-group">
                                {{ Form::label('streetnumber', 'Nummer', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="streetnumber"
                                       value="{{$deelnemer->streetnumber}}">
                            </div>
                            <div class="form-group">
                                {{ Form::label('postcode', 'Postcode', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="postcode"
                                       value="{{$deelnemer->postcode}}">
                            </div>

                            <div class="form-group">
                                {{ Form::label('question', 'Antwoord', array('class' => 'control-label pull-left' )) }}
                                <input type="text" class="form-control" name="question"
                                       value="{{$deelnemer->question}}">
                            </div>

                        </div>
                    </div>


                    <div class="form-group">
                        {{ Form::submit('aanpassen', array('class' => 'btn btnLarge')) }}
                    </div>
                    {!! Form::close() !!}
































                </section>
            </div>
        </div>
    </div>
@endsection


