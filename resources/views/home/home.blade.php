@extends('Index')

@section('content')
    <div>
        <div id="home">
        <div class="row">
            <div class="col-lg-offset-4 col-lg-8 col-md-8 col-md-offset-4 col-sm-12" id="contentLanding">

                <div>
                    <h2>Wie wordt de nieuwe <span id="jupiler">Jupiler</span> winnaar??</h2>

                    <p>Doe mee aan onze shiftingsvraag en maak kans op 5 meter bier .
                        <br> Beantwoord de vraag correct en je wordt verwittigd per e-mail! </p>
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

                    @foreach($winnaars as $winnaar)
                        <ul>
                            <li>{{$winnaar->deelnemer->firstname}} {{$winnaar->deelnemer->lastname}}</li>
                        </ul>
                    @endforeach
                </div>

            </div>
        </div>
        </div>
    </div>


@endsection