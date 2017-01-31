@extends('basenofooter')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
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

					<form class="form-horizontal" role="form" method="POST" action="register">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Name</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="text" class="form-control" name="name" required="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Your Phone Number</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="tel" class="form-control" name="tel" id="tel" required="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Verification Code</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control" name="smscode" required="">
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<button type="button" onclick="sendSMS(this)" class="btn btn-primary">
									send code
								</button>
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Password</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="password" class="form-control" name="password" required="">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Confirm Password</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="password" class="form-control" name="password_confirmation" required="">
							</div>
						</div>

						<input name="verismscode" id="code" type="hidden" value="{{$code}}">

						<div class="form-group">
							<div class="col-md-6 col-md-offset-3">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
@endsection