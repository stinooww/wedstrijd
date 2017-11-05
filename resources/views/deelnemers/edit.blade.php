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
                    <div class="col-sm-6">
                        <div class="col-sm-5 col-sm-offset-1 pull-right">
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
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-5 col-sm-offset-1">
                            <div class="form-group">
                                {{ Form::label('street', 'Straatnaam', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="street" value="{{$deelnemer->street}}">
                            </div>
                            <div class="form-group">
                                {{ Form::label('housenumber', 'Nummer', array('class' => 'control-label pull-left')) }}
                                <input type="text" class="form-control" name="housenumber"
                                       value="{{$deelnemer->housenumber}}">
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
                            <div class="hidden">
                                {{ Form::label('ipadress', 'ipadress', array('class' => '' )) }}
                                <input type="text" class="hidden" name="ipadress" value="{{$deelnemer->ipadress}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group">
                            {{ Form::label('has_permission', 'Maakt kans om te winnen', array('class' => 'control-label' )) }}
                            {{ Form::checkbox('has_permission', 'has_permission',array('class' => 'control-label')) }}
                        </div>
                    </div>
                    <div class="form-group">
                        {{ Form::submit('aanpassen', array('class' => 'btn btn-primary')) }}
                    </div>
                    {!! Form::close() !!}
































                </section>
            </div>
        </div>
    </div>
@endsection


