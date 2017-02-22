@extends('basenofooter')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 card card-2">
				<div style="font-family:NexaBold;font-size:32px;">Sign in</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Wrong username or wrong password!</strong><br><a href = "/password/email" style="background-color:inherit;">Forgot your password?</a>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<input type="tel" class="form-control" name="tel" placeholder="PHONE NUMBER" required="">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="PASSWORD" required="">
						</div>

						<div class="form-group" style="text-align:left; padding-left:3px;">
							<label class="control-label">
								<input type="checkbox" name="remember"> Remember Me
							</label>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary col-md-12">SIGN IN</button>
						</div>
						<div class="form-group" style="text-align:center;font-size:15px;">
							Forgot Your Password? <a href="/password/email" style="color:#65C1FF"><u>Click here</u></a>
						</div>
					</form>
				</div>
		</div>
@endsection

