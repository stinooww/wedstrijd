@extends('Index')
@section('content')


    @if (Auth::check())
        <div class="container">
            <div class="row">
                <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">


                    <div class="breadcrumb col-lg-4 col-md-4">

                        <a href="{{ route('dashboard') }}"><- ga terug</a>

                        <br>
                        <br>


                    </div>
                    @include("feedback.session")
                    @include("feedback.error")

                    <div class="clearfix "></div>

                    <section class="deelnemer">


                        <h3>Deelnemers:</h3>

                            @foreach($deelnemerslijst as $deelnemer )
                                <div class="col-md-4">
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            Naam: {{ $deelnemer->firstname }} {{ $deelnemer->lastname }}</li>

                                        <li class="list-group-item">E-mail: {{ $deelnemer->email }}</li>
                                        <li class="list-group-item">
                                            Adres: {{$deelnemer->street}} {{$deelnemer->housenumber}}</li>
                                        <li class="list-group-item">Postcode: {{$deelnemer->postcode}} </li>
                                        <li class="list-group-item">
                                            Gedisqualificeerd: {{ $deelnemer->disqualified }}</li>
                                        <li class="list-group-item">Speler verwijderd: {{ $deelnemer->is_deleted }}</li>
                                        <li>
                                            <a class="btn btnLarge" href="{{ route('editdeelnemer', $deelnemer->id) }}">Deelnemer
                                                aanpassen </a>
                                        </li>

                                    </ul>
                                </div>
                            @endforeach
                        {{--@endif--}}

                        {!! Form::open(array('route' => 'create_excel')) !!}
                        {{ Form::submit('Download Excel', array('class' => 'btn btn-primary pull-right')) }}
                        {!! Form::close() !!}

                        {!! Form::open(array('route' => 'send_mail')) !!}
                        {{ Form::submit('Verstuur mail', array('class' => 'btn btn-primary pull-right')) }}
                        {!! Form::close() !!}
                    </section>

                </div>
            </div>
        </div>
    @endif




@endsection