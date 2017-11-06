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
                                            Adres: {{$deelnemer->streetname}} {{$deelnemer->streetnumber}}</li>
                                        <li class="list-group-item">Postcode: {{$deelnemer->postcode}} </li>
                                        <li class="list-group-item"> Gedisqualificeerd: {{ $deelnemer->qualified }}</li>

                                        <li class="list-group-item">Speler verwijderd: {{ $deelnemer->is_deleted }}</li>
                                        <li>
                                            <a class="btn btnLarge" href="{{ route('editdeelnemer', $deelnemer->id) }}">Deelnemer
                                                aanpassen </a>
                                        </li>

                                    </ul>
                                </div>
                            @endforeach
                        {{--@endif--}}

                    </section>
                    <div class="clearfix "></div>
                    <section class="extra ">
                        {!! Form::open(array('route' => 'excel')) !!}
                        {{ Form::submit('Download Excel', array('class' => 'btn btnLarge ')) }}
                        {!! Form::close() !!}
                        <br>
                        {!! Form::open(array('route' => 'email')) !!}
                        {{ Form::submit('Verstuur mail', array('class' => 'btn btnLarge ')) }}
                        {!! Form::close() !!}
                    </section>

                </div>
            </div>
        </div>
    @endif




@endsection