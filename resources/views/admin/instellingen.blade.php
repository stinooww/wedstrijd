@extends('Index')
@section('content')


    <div class="col-sm-12 push">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">terug naar dashboard</a>
    </div>


    <div class="col-sm-12">
        <div class="col-sm-6">
            <a href="#" class="btn btn-primary col-sm-6 col-sm-offset-3 ">
                toon ontvangers
            </a>
        </div>
        <div class="col-sm-6">
            <a href="#" class="btn btn-primary  col-sm-6 col-sm-offset-3 ">
                toon periodes
            </a>
        </div>
    </div>

    <div class="col-sm-12">
        @if(count($periods) > 0)
            @foreach($periods as $p)
                <div class="col-sm-3">
                    <ul class="list-group">
                        <div class="period-content hidden" id="{{$p->id}}">
                            <li class="list-group-item active">
                                Periode: {{$p->id}}
                            </li>
                            <li class="list-group-item">
                                Start: {{ date('d-m-Y', strtotime($p->startDate)) }}
                            </li>
                            <li class="list-group-item">
                                Eind: {{ date('d-m-Y', strtotime($p->endDate)) }}
                            </li>

                            <li class="list-group-item">
                                Naam winnaar: {{  $p->winner_name}}
                            </li>
                            <li class="list-group-item">
                                Email winnaar: {{  $p->winner_email}}
                            </li>
                            <li class="list-group-item">
                                <a class="btn btn-primary" href="{{ route('edit_period', $p->id) }}">aanpassen</a>
                            </li>
                        </div>
                    </ul>
                </div>
            @endforeach
        @endif
    </div>

    <div class="col-sm-12">
        @if(count($mm) > 0)
            @foreach($mm as $manager)
                <div class="col-sm-3 manager-content hidden">
                    <ul class="list-group">
                        <li class="list-group-item active">Manager ID: {{ $manager->id }}</li>
                        <li class="list-group-item">Naam: {{ $manager->name }}</li>
                        <li class="list-group-item">E-mail: {{ $manager->email }}</li>
                        <li class="list-group-item"><a class="btn btn-primary btn-sm"
                                                       href="{{ route('edit_email_manager', $manager->id ) }}">edit</a>
                        </li>
                    </ul>
                </div>
            @endforeach
        @endif
    </div>

    <div class="col-sm-12">
        <div class="col-sm-6">
            <h2 class="text-center">Excel ontvangers</h2>
            <div class="col-sm-6 col-sm-offset-3">
                {!! Form::open(array('route' => 'create_email_manager', 'class' => 'form-horizontal')) !!}
                {{ csrf_field() }}
                <div class="form-group">
                    {{ Form::label('Naam'), "name" }}
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <div class="form-group">
                    {{ Form::label('Email'), "email" }}
                    <input type="text" class="form-control" name="email" id="email">
                </div>
                <div class="form-group">
                    {{ Form::label('Competitie ID'), "competition_id" }}
                    @foreach($comps as $c)
                        {{ Form::select('competition_id', [$c->id => $c->id]) }}
                    @endforeach
                </div>
                <div class="form-group">
                    {{ Form::submit('toevoegen', array('class' => 'btn btn-primary')) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="col-sm-6">
            <h2 class="text-center">Periodes</h2>
            <div class="col-sm-6 col-sm-offset-3">
                {!! Form::open(array('route' => 'create_period', 'class' => 'form-horizontal'))  !!}
                {{ csrf_field() }}
                <div class="form-group">
                    {{ Form::label('startDate', 'Start', array('class' => 'control-label')) }}
                    <input type="text" class="form-control" name="startDate" id="startDate">
                </div>
                <div class="form-group">
                    {{ Form::label('endDate', 'Eind', array('class' => 'control-label')) }}
                    <input type="text" class="form-control" name="endDate" id="endDate">
                </div>

                <div class="form-group">
                    {{ Form::label('Competitie ID'), "competition_id" }}
                    @foreach($comps as $c)
                        {{ Form::select('competition_id', [$c->id => $c->id]) }}
                    @endforeach
                </div>

                <div class="form-group">
                    {{ Form::submit('toevoegen', array('class' => 'btn btn-primary')) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    </div>

@endsection