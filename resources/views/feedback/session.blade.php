@if(Session::has('flash_message'))
    <div class="alert alert-danger">
        {{Session::get('flash_message')}}
    </div>
@endif


{{--@if(session()->has('message.level'))--}}
{{--<div class="alert alert-{{ session('message.level') }}">--}}
{{--{!! session('message.content') !!}--}}
{{--</div>--}}
{{--@endif--}}

{{--public function store(Request $request) {--}}
{{--if (Post::create($request->all())) {--}}
{{--$request->session()->flash('message.level', 'success');--}}
{{--$request->session()->flash('message.content', 'Post was successfully added!');--}}
{{--} else {--}}
{{--$request->session()->flash('message.level', 'danger');--}}
{{--$request->session()->flash('message.content', 'Error!');--}}
{{--}--}}
{{--return redirect('/');--}}
{{--}--}}