@yield('Index')
@section('content')
    @include('layouts.app')
    <div class="landing">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">


                <h1>Wie word de nieuwe jupiler winnaar??</h1>

                <p>De jupiler wedstrijd gaat als volgt: registreer jezelf en vul dan de super moeilijke vraag in. Als
                    deze juist is word je verwittigd per mail. Je mag maar 1 keer meedoen per wedstrijd</p>
                <div class="calltoAction">
                    <li class="registreerKnop">
                        <a href="{{ url('/register') }}">Registreer je hier</a>
                    </li>
                </div>
            </div>
        </div>


    </div>
    <div class="lijst">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <h1>Dit is het overzicht van alle winnaars van de vorige periodes</h1>
            </div>
        </div>
    </div>

@endsection