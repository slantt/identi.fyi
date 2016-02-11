@extends('template')

@section('head')

    <title>{{$user->name}}</title>

@endsection

@section('body-class')
    dark
@endsection
@section('content')

    <div class="col-md-12">
        <div class="col-md-6">
            <div class="panel panel-default shadow-2 profile-panel">
			<div class = "header-group">
			
                <h1 class="text-center" style = "display: inline-block">{{ $user->name }}</h1>
				
				@if($user->img!="")
				
				<div class="page-card profile-img-card">
				
					<img class = "thumbnail profile-picture" src="{{URL::to("/")}}/ProfileImages/{{$user->img}}">
				
				</div>
				
				@endif
				
				</div>
				
                <div class="page-card">
                    <div class="text-muted">About me</div>{{ $user->bio  }}</div>
					
				@if($user->experience!="")
					
					<div class="page-card">
					<div class="text-muted">Experience</div>{{$user->experience}}</div>
				
				@endif

                @if($user->job!="")
                    <div class="page-card">
                        <div class="text-muted">Job Title</div>{{$user->job}}</div>
                @endif

                @if($user->phone!="")
                    <div class="page-card">
                        <div class="text-muted">Phone Number</div>{{$user->phone}}</div>
                @endif

                @if($user->city!="")
                    <div class="page-card">
                        <div class="text-muted">Area</div>{{$user->city}}</div>
                @endif

                @if($user->website!="")
                    <div class="page-card">
                        <div class="text-muted">Website</div>
                        <a href="{{$user->website}}}">{{$user->website}}</a></div>
                @endif

            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default shadow-2 profile-panel">
                <h2 class="text-center">Social Media</h2>
                <div class="list">

                    @foreach($user->socials as $link)
                        <div class="page-card">
                        <div class="text-muted"><?php $title_array = explode(".", $link->title); echo ucfirst($title_array[0]); ?></div>
                            <a href="{{ $link->link }}">{{ $link->title }}</a>
                        </div>
                    @endforeach

                </div>

            </div>
        </div>

    </div>

@endsection