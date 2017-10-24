@extends('Index')

@section('content')
    <div>
        <div id="home">
        <div class="row">
            <div class="col-lg-offset-4 col-lg-8 col-md-8 col-md-offset-4 col-sm-12" id="contentLanding">

                <div>
                    <h2>Wie word de nieuwe <span id="jupiler">Jupiler</span> winnaar??</h2>

                    <p>Vul de super moeilijke vraag in met al je gegevens en maak kans op 5 meter bier .
                        <br> Als je de vraag juist hebt beantwoord zal je worden verwittigd per e-mail! </p>
                </div>


                <div id="calltoAction">
                    <li class="registreerKnop">
                        <a id="call" href="{{ route('inschrijvingspagina') }}">Doe mee aan de wedstrijd</a>
                    </li>
                </div>
            </div>
        </div>


    </div>
        <div id="lijst">
        <div class="row">
            <div class="col-lg-offset-4 col-lg-8 col-md-8 col-md-offset-4 col-sm-12" id="lijstWinnaars">
                <h2>Overzicht van al de winnaars van vorige periodes</h2>
                <div class="winnaarslijst">
                    <a href="{{ route('homepage') }}">home</a>
                    {{--@foreach($winnaars as $winnaar)--}}
                    {{--<ul>--}}
                    {{--<li>{{$winnaar->name}}</li>--}}
                    {{--</ul>--}}
                    {{--@endforeach--}}
                </div>

            </div>
        </div>
        </div>
    </div>


@endsection