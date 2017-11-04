@extends('Index')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">
                @if($wedstrijd)

                    <div class="breadcrumb col-lg-4 col-md-4">

                        <a href="{{ route('homepage') }}"><- ga terug</a>

                        <br>
                        <br>


                    </div>
                    @include("feedback.session")
                    @include("feedback.error")

                    <div class="clearfix "></div>

                    <section class="wedstrijd">

                        <p>Vul de super moeilijke vraag in met al je gegevens en maak kans op 5 meter bier .
                            <br> Als je de vraag juist hebt beantwoord zal je worden verwittigd per e-mail! </p>


                        @if(count( $actieve_wedstrijd) > 0)
                            <div class="col-md-6 col-md-offset-3">
                                <h2>Huidige wedstrijd</h2>
                                @foreach($actieve_wedstrijd as $wedstrijd)
                                    <p>Wedstrijdnaam: {{ $wedstrijd->name }}</p>
                                    <p>Start datum: {{ $wedstrijd->start_date }}</p>
                                    <p>Eind datum: {{ $wedstrijd->end_date }}</p>
                                @endforeach
                            </div>
                        @endif

                    </section>




                    <div class="clearfix "></div>

                    <div class="col-sm-12 text-center">


                        @if(Auth::check())
                            <div class="col-sm-4 text-center">
                                <a class="btn btnLarge" href="{{ route('editwedstrijd',$actieve_wedstrijd->id) }}">Wedstrijd
                                    aanpassen</a>
                            </div>

                        @endif


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