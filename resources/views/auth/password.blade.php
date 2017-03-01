@extends('basenofooter')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 card card-2">
			<div style="font-family:NexaBold;font-size:32px;">Forgot Password?</div>
				<div class="panel-body">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Invaild e-mail address</strong>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
								<input type="tel" class="form-control" name="tel" id="tel" placeholder="PHONE NUMBER" required="">
							</div>
								<button type="button" onclick="sendSMSPassword(this)" class="btn btn-primary col-lg-4 col-md-4 col-sm-4 col-xs-4">Send New Password</button>
						</div>
				</div>
			</div>
@endsection
