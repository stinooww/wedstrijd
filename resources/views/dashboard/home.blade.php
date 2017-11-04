@extends('Index')
@section('content')


    @if (Auth::check())

        <div>
            <ul>
                <li class="col-lg-5 col-md-5 col-sm-12">
                    <a href="{{ route('deelnemerspagina') }}">
                        Deeelnemerslijst </a></li>
                <li class="col-lg-5 col-md-5 col-sm-12">
                    <a href="{{ route('verantwoordelijkelijst') }}">

                        wedstrijd verantwoordelijkelijst</a></li>

                <li class="col-lg-5 col-md-5 col-sm-12">
                    <a href="{{ route('wedstrijdindex') }}">
                        Stel een wedstrijd in</a>
                </li>
                <li></li>
            </ul>
        </div>

    @endif




@endsection