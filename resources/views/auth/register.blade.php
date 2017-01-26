@extends('base')

@section('content')
		<div class="col-xs-12 col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3" style="margin-top:60px;padding-right: 0px;padding-left: 0px;left:-8px">
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
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="text" class="form-control" name="name">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Your Phone Number</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="tel" class="form-control" name="tel" id="tel">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Verification Code</label>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<input type="text" class="form-control" name="smscode">
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
								<button onclick="sendSMS()" class="btn btn-primary">
									send code
								</button>
							</div>
						</div>



						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Password</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-lg-3 col-md-3 col-sm-3 col-xs-4 control-label">Confirm Password</label>
							<div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
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

<script type="text/javascript">
	$("#aboutUs").css("display")="none";
        function sendSMS(){
            s = document.getElementById('tel').value;
            if(s){
            window.location.href="/api/items/search/" + s;
            }
            else
                alert("please input a right cell phone number!"); 
        }
    </script>