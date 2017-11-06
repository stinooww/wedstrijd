@extends('Index')
@section('content')

    <div class="container">
        <div class="row">
    @if (Auth::check())

                <div class="dashboard col-md-6 col-sm-12 col-md-offset-4">
            <ul>
                <li class="col-lg-5 col-md-5 col-sm-12">
                    <a href="{{ route('deelnemerspagina') }}">
                        Deelnemerslijst </a></li>
                <li class="col-lg-5 col-md-5 col-sm-12">
                    <a href="{{ route('adminindex') }}">

                        Admin/verantwoordelijke lijst</a></li>

                <li class="col-lg-5 col-md-5 col-sm-12">
                    <a href="{{ route('wedstrijdindex') }}">
                        Stel een wedstrijd in</a>
                </li>
                {{--<li></li>--}}
            </ul>
        </div>

    @endif

        </div>
    </div>


@endsection