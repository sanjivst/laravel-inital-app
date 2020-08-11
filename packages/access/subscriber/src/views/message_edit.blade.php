@extends('theme::layouts.my_frame')
@section('content')

	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<form method="post" action="{{url('admin/messages')}}/{{$message->id}}">
					@csrf
					@method('PUT')

					<div class="box-body">
						<div class="form-group">
							<label for="name">Sender Name : </label>
							<div class="form-control">
								<div id="name">
									{{$message->subscriber->name}}
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="subscriber_id">Sender Email :</label>
							<div class="form-control">
								<div class="form-control-plaintext" >
									{{$message->subscriber->email}}
								</div>
								<input type="hidden" name="subscriber_id" id="subscriber_id" value="{{$message->subscriber->id}}">
							</div>
						</div>
						<div class="form-group">
							<label for="subject">Subject:</label>
							<input class="form-control form-control-sm" id="subject" name="subject" type="text"
								   value="{{$message->subject}}">
						</div>
						<div class="form-group">
							<label for="contents">Message :</label>
							<input class="form-control form-control-sm" name="contents" id="contents" type="text"
								   value="{{$message->contents}}">
						</div>
					</div>
					<div class="box-footer">
						<button type="submit" class="btn btn-success">Update</button>
						<button type="reset" class="btn btn-danger">Reset</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<script>
		$('.messages').addClass('active');
		$('.subscribers').addClass('active');
	</script>
@endsection