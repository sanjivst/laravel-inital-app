@extends('theme::layouts.my_frame')
@section('content')
	<style>
		.msg-contents
		{
			border-top:2px double #00A0D1;
			border-bottom:1px double #00A0D1;
			min-height:100px;
		}
	</style>

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">

					<dl class="dl-horizontal">
						<dt>Sender : </dt>
						<dd> {{$message->subscriber->name}}</dd>
						<dt>Email : </dt>
						<dd>{{$message->subscriber->email}}</dd>
						<dt>Subject : </dt>
						<dd>{{$message->subject}}</dd>
						<div class="alert alert-dismissible">
							<h4> Message :</h4>
							<p class="msg-contents">
								{{$message->contents}}
							</p>
						</div>
					</dl>
				</div>
			</div>
		</div>
	</div>

	<script>

		$('.subscribers').addClass('active');
		$('.messages').addClass('active');
	</script>

@endsection