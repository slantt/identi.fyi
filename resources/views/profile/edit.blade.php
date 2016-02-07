@extends('template')

@section('head')

<link rel="stylesheet" href="/edit.css">

<title>{{$user->name}} | Edit</title>

@endsection

@section('body-class')
    dark
@endsection

@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default shadow-2 profile-panel add-padding">
            <h1 class="text-center">Editing Your Profile</h1>
            <h4 class="text-center">( Profile Of {{ $user->name }} )</h4>
			<form action="" method="post">
	<!-- Text Input Type (Name) -->
				<label>
	        		Name
	            </label><br>
	            <i><input type="text" class="form-control" value="{{ $user->name }}" name="name"><br></i>
	<!-- Textarea Input Type (Bio) -->
	            <label>
	        		Bio
	            </label>
	            <i><textarea name="bio" class="form-control">{{ $user->bio }}</textarea></i><br>
	<!-- Text Input Type (Email) -->
	            <label>
	        		Email
	            </label><br>
	            <i><input type="text" class="form-control" value="{{ $user->email }}" name="email"><br></i>
	<!-- Text Input Type (Twitter) -->
				<label>
					Twitter
				</label>
				<i><div class="input-group">
				<span class="input-group-addon">@</span>
                <input name="twitter" type="text" class="form-control" value="{{$user->twitter}}" placeholder="You're Twitter Name">
            </div><br></i>
	<!-- Text Input Type (Facebook) -->
				<label>
					Facebook
				</label>
				<i><div class="input-group">
				<span class="input-group-addon">http://www.Facebook.com/</span>
                <input name="facebook" type="text" class="form-control" value="{{$user->facebook}}" placeholder="You're Facebook URL">
            </div><br></i>
	<!-- Text Input Type (LinkedIn) -->
				<label>
					LinkedIn
				</label>
				<i><div class="input-group">
				<span class="input-group-addon">http://www.LinkedIn.com/In/</span>
                <input name="linkedin" type="text" class="form-control" value="{{$user->linkedin}}" placeholder="You're LinkedIn URL">
            </div><br></i>
	<!-- Text Input Type (City/Town) -->
				<label>
					City / Town
				</label>
				<i>
                <input name="city" type="text" class="form-control" placeholder="Your City / Town" value="{{$user->city}}"><br><br></i>
	<!-- Submit Input Type (Save Changes Button) -->
	            <input type="submit" value="Save Changes" class="form-control">
	        </form>
        </div>
    </div>
@endsection