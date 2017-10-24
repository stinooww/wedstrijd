@extends('Index')
@section('content')


    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-9 col-md-3 col-md-9 col-sm-12">
                {!! Form::open(array('url'=>'home/store','files'=>true)) !!}
                <div class="breadcrumb col-lg-4 col-md-4">

                    <a href="{{ route('homepage') }}">ga terug</a>

                </div>
                <div class="clearfix "></div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> {{ $error }}</li>
                            @endforeach

                        </ul>
                    </div>
                @endif

                <div class="form-group inputss">
                    {!! Form::label('naam', 'titel (max. 255 karakters)',['class'=> 'col-md-4 control-label'])  !!}
                    <div class="col-md-5 inputss">
                        {!! Form::text('titel', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('inleiding', 'inleiding',['class'=> 'col-md-4 control-label']) !!}
                    <div class="col-md-6 inputss">
                        {!! Form::textarea('inleiding', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('url', 'URL',['class'=> 'col-md-4 control-label']) !!}
                    <div class="col-md-5 inputss">
                        {!! Form::text('url', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="form-group inputss">
                    {!! Form::label('foto', 'foto',['class'=> 'col-md-4 control-label']) !!}
                    <div class="col-md-5 inputss">
                        {!! Form::file('foto') !!}
                    </div>
                </div>

                <div class="form-group inputss">
                    <div class="col-md-offset-4 col-md-5">
                        {!! Form::submit('toevoegen',['class'=>'btn btn-primary form-control']) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>



@endsection
