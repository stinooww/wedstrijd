@extends('Index')
@section('content')


    <div class="breadcrumb col-lg-4 col-md-4">

        <a href="{{ route('dashboard') }}"><- ga terug</a>

        <br>
        <br>


    </div>
    @include("feedback.session")
    @include("feedback.error")
    <div class="clearfix "></div>
    <section class="wedstrijd">
        <h3 class="col-md-4 col-md-offset-3">Wedstrijd verantwoordelijke</h3>

        @foreach($adminList as $admin)
            <div class="col-md-4 col-md-offset-2">


                <p>Adminnaam: {{ $admin->name }}</p>
                <p>Admin emaildres: {{ $admin->email }}</p>
                @if($admin->role_id == 2)
                    <p>Functie: wedstrijd verantwoordelijke / admin </p>

                @else
                    <p>Functie: Normal user </p>

                @endif
                <a class="btn btnLarge" href="{{ route('adminupdate', $admin->id) }}">Admin
                    aanpassen </a>


            </div>

        @endforeach
    </section>


@endsection