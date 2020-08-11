@extends('theme::layouts.my_frame')
@section('content')

	<div class="container-fluid">
		<div class="container">
			<div class="container">
				<h1>{{$post->title}}</h1>
				<p>
					{!!$post->description!!}
				</p>

			</div>
		</div>
	</div>

<script>
	$(function () {
		$(".posts").addClass('active');
	});
</script>
@endsection