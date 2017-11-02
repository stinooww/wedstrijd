@extends('Index')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-offset-2 col-lg-10 col-md-offset-2 col-md-10 col-sm-12">
                <h1>Uw inzending is geslaagd !</h1>
                <p>
                    Bedankt voor uw deelname.
                    Als u 1 van de winnende deelnemers bent krijgt u een email !!
                </p>
                <a href="{{ route('homepage') }}"><- ga terug</a>
            </div>
        </div>
    </div>
@endsection