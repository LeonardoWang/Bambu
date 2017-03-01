@extends('basenofooter')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 card card-2">
			<div style="font-family:NexaBold;font-size:32px;">Change Password</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Wrong username or wrong password!<br><a href = "/password/email">Forgot your password?</a></strong>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="api/resetPassword">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<!--<div class="form-group">
								<input type="tel" class="form-control" name="tel"id="tel" placeholder="PHONE NUMBER">
						</div>

						<div class="form-group">
							<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style="padding-left:0px;">
								<input type="text" class="form-control" name="smscode" placeholder="Verification Code" required="">
							</div>
								<button type="button" onclick="sendSMS(this)" class="btn btn-primary col-lg-4 col-md-4 col-sm-4 col-xs-4">send code</button>
						</div>-->

						<div class="form-group">
							<input type="password" class="form-control" name="password_old" placeholder="OLD PASSWORD">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="NEW PASSWORD">
						</div>

						<div class="form-group">
								<input type="password" class="form-control" name="password_confirmation" placeholder="CONFIRM PASSWORD">
						</div>

						<div class="form-group">
							<button type="submit" class="btn btn-primary col-md-12">
								Create Password
							</button>
						</div>
					</form>
				</div>
			</div>
@endsection
