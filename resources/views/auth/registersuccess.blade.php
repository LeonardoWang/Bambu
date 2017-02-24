@extends('basenofooter')

@section('content')
	<h3 style="font-family:Nexabold; font-weight:300;">
		Registration Complete<br><br>
		<img style="width:250px;" src="/img/thumb.png"></img><br><br>
		Welcome to Bambu!
	</h3>
	<script type="text/javascript">setTimeout('go()',3000); 
	function go(){
	window.location.href='/';
	}
	</script>
@endsection