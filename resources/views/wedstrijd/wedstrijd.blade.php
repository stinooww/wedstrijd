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
                    @include("feedback.session")
                    @include("feedback.error")
                @if($actieve_wedstrijd)
                    <div class="clearfix "></div>

                    <section class="wedstrijd">

                        <p>Vul de super moeilijke vraag in met al je gegevens en maak kans op 5 meter bier .
                            <br> Als je de vraag juist hebt beantwoord zal je worden verwittigd per e-mail! </p>



                            <div class="col-md-6 col-md-offset-3">
                                <h3>Huidige wedstrijd</h3>
                                @foreach($actieve_wedstrijd as $activeGame)
                                    <p>Wedstrijdid: {{ $activeGame->id }}</p>
                                    <p>Wedstrijdnaam: {{ $activeGame->name }}</p>
                                    <p>Start datum: {{ $activeGame->start_date }}</p>
                                    <p>Eind datum: {{ $activeGame->end_date }}</p>

                            </div>


                    </section>




                    <div class="clearfix "></div>

                    <div class="col-sm-12 text-center">


                        @if(Auth::check())
                            <div class="col-sm-4 text-center">
                                <a class="btn btnLarge" href="{{ route('editwedstrijd',$activeGame->id) }}">Wedstrijd
                                    aanpassen</a>
                            </div>
                        @endif

                        @endforeach
                        @else

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