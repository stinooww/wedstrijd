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


                </section>
            </div>
        </div>
    </div>
@endsection


