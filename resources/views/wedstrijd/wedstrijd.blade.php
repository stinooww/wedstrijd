@extends('Index')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">


                    <div class="breadcrumb col-lg-4 col-md-4">

                        <a href="{{ route('homepage') }}"><- ga terug</a>

                        <br>
                        <br>


                    </div>
                <div class="clearfix "></div>
                    @include("feedback.session")
                    @include("feedback.error")

                    <div class="clearfix "></div>

                    <section class="wedstrijd">

                        <p>Vul de wedstrijd vraag in met al je gegevens en maak kans op 5 meter bier .
                            <br> Als je de vraag juist hebt beantwoord zal je worden verwittigd per e-mail! </p>

                        <a id="call" class="btnLarge" href="{{ route('inschrijvingspagina') }}">Doe mee aan de
                            wedstrijd</a>
                        <div id="fb-root"></div>
                        <script>(function (d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s);
                                js.id = id;
                                js.src = 'https://connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.11&appId=229825640885462';
                                fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                        <div class="fb-share-button" data-href="https://wedstrijd.stijn.heynderickx.mtantwerp.eu/"
                             data-layout="button_count" data-size="large" data-mobile-iframe="true"><a
                                    class="fb-xfbml-parse-ignore" target="_blank"
                                    href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwedstrijd.stijn.heynderickx.mtantwerp.eu%2F&amp;src=sdkpreparse">Delen</a>
                        </div>
                        <div class="clearfix "></div>

                        @if($wedstrijd)
                            <div class="col-md-6 col-md-offset-3">
                                <h3>Huidige wedstrijd</h3>

                                @foreach($actieve_wedstrijd as $activeGame)
                                    <p>Wedstrijdid: {{ $activeGame->id }}</p>
                                    <p>Wedstrijdnaam: {{ $activeGame->name }}</p>
                                    <p>Aantal dagen: {{ $activeGame->periode }}</p>
                                    <p>Start datum: {{ $activeGame->start_date }}</p>
                                    <p>Eind datum: {{ $activeGame->end_date }}</p>

                            </div>


                    </section>




                    <div class="clearfix "></div>

                    <div class="col-sm-12 text-center">
                        <br>
                        <br>

                        @if(Auth::check())
                            <div class="col-sm-4 text-center">
                                <a class="btn btnLarge" href="{{ route('editwedstrijd',$activeGame->id) }}">Wedstrijd
                                    aanpassen</a>
                            </div>
                        @endif

                        @endforeach
                        @else
                            <br>
                            <br>
                            @if(Auth::check())
                                <div class="col-sm-4 col-sm-offset-2">
                                    <a class="btn btnLarge" href="{{ route('createwedstrijd') }}">Wedstrijd aanmaken</a>
                                </div>

                            @endif
                        @endif

                    </div>

            </div>
        </div>
    </div>
@endsection