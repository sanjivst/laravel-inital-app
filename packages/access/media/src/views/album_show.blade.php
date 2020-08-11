@extends('theme::layouts.my_frame')
@section('content')
<div class="container-fluid">
	<div class="container">

	<div>
		{{$album->name}}
	</div>
	<div>
		{{$album->description}}
	</div>
		
	<div>
		<img src="{{asset('thumbnailuploads')}}/{{$album->thumbnail}}" alt="image" height="100">
	</div>
	<h3>lists of gallery</h3>
	@foreach($album->galleries as $gallery)
		{{$gallery}}
	@endforeach

@endsection