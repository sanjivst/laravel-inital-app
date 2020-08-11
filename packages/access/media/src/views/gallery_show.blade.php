@extends('theme::layouts.my_frame')
@section('content')
	<style>
		figure{
			display: inline-block;
		}
		figure figcaption
		{
			text-align: center;
		}
	</style>

<div class="container-fluid">
			<div class="container">
				
		<h2>{{$gallery->name}}</h2>
				@foreach($gallery->media as $key =>  $item)
					<figure>
						<img src="{{asset('/images/').'/'.$item->filename}}" alt='missing'  height="250px" />
						<figcaption>{{$item->name}}</figcaption>
					</figure>
				@endforeach
			</div>
</div>

@endsection