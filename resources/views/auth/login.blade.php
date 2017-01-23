@extends('base')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
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

					<form class="form-horizontal" role="form" method="POST" action="login">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-xs-4 control-label">Phone Number</label>
							<div class="col-lg-9 col-md-9 col-xs-8">
								<input type="tel" class="form-control" name="tel" value="{{ old('tel') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-xs-4 control-label">Password</label>
							<div class="col-lg-9 col-md-9 col-xs-8">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="row">
							<div class="col-lg-4 col-lg-offset-2 col-md-6 col-md-offset-1 col-xs-2 col-xs-offset-2">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
							<div class="col-lg-1 col-lg-offset-3 col-md-1 col-md-offset-3 col-xs-2 col-xs-offset-5">
								<button type="submit" class="btn btn-primary" style="margin-right: 15px;">Login</button>
							</div>
							</div>
						</div>
						<div class="form-group" style="text-align:right;">
							<a href="/password/email" class="login-link">Forgot Your Password?</a><br>
							<a href="/register" class="login-link">Register now</a>
						</div>
					</form>
				</div>
			</div>
		</div>
@endsection
