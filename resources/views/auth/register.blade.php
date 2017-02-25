@extends('basenofooter')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 card card-2">
			<div style="font-family:NexaBold;font-size:32px;">Register</div>
					<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Error:</strong><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<label>Already have a bambu account? <a href="/login" style="color:#65C1FF"><u>Sign in here</u></a></label>
					<form class="form-horizontal" role="form" method="POST" action="register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<input type="text" class="form-control" name="name" placeholder="NAME" required="">
						</div>

						<div class="form-group">
							<input type="tel" class="form-control" name="tel" id="tel" placeholder="PHONE NUMBER" required="">
						</div>

						<div class="form-group">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
								<input type="text" class="form-control" name="smscode" placeholder="Verification Code" required="">
							</div>
								<button type="button" onclick="sendSMS(this)" class="btn btn-primary col-lg-4 col-md-4 col-sm-4 col-xs-4">send code</button>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="email" placeholder="EMAIL" required="">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="PASSWORD" required="">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" placeholder="CONFIRM PASSWORD" required="">
						</div>

						<input name="verismscode" id="code" type="hidden" value="{{$code}}">

						<div class="form-group">
								<button type="submit" class="btn btn-primary col-md-12">
									Register
								</button>
						</div>
					</form>
				</div>
		</div>
@endsection