@extends('base')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3" style="margin-top:60px;">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
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
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Your Phone Number</label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input type="tel" class="form-control" name="tel" value="{{ old('tel') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Password</label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Confirm Password</label>
							<div class="col-lg-9 col-md-9 col-sm-9 col-xs-8">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

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
