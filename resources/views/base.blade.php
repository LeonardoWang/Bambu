<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bambu, your idle items trading app</title>
        <meta name="description" content="Bambu, your idle items trading app."/>

        <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <!-- Loading mycss -->
        <link href="/css/mycss.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900" rel="stylesheet" type="text/css">

        <link rel="shortcut icon" href="/img/favicon.ico">

        <!-- bambu-color1:#e53935;
        bambu-color2:#f44336;
        grey:#bdc3c7;
    -->
    </head>

    <body>
<div class="col-lg-12" style="margin-left:0px;margin-right:0px;">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="navbar-header bambu-color1">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <img id="home" onclick="home()" src='/img/favicon.ico'>
            </div>
            <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">
              <ul class="nav navbar-nav">
                <li>
                @if (isset($user) > 0)
                    <a href="/api/users_information"> hello, {{$user->name}} </a></li><li>
                    <a href="/logout" >logout</a>
                @else
                    <a href="/login" >login</a>
                @endif
                </li>
                <li>
                    <a href ="/api/product">post item</a>
                </li>
                <li>
                    <a href="/api/product/myProduct">my items</a>
                </li>
                <li><a href="#aboutUs">about us</a></li>
                <li><div class="navbar-form navbar-right">
                    <div class="form-group">
                    <input type="text" id="inpu1" name="keyword" class="form-control" placeholder="Search"/>
                    </div>
                    <button onclick="sb()" class="btn btn-primary bambu-color1" style="background-color:#f44336">search</button>
                    </div>
                </li>
               </ul>
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
    </div>

<div class="container" style="width:100%; padding-left: 0px; margin-left: 0px;">
    <div class="row">
        @yield('content')
    </div>
</div>

<footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p style="text-align:center;"> copyright@Onesia Group ltd.. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:bambu@pku.edu.cn">contact us</a></p>
</footer>

</body>
    <script type="text/javascript">
        function sb(){
            s = document.getElementById('inpu1').value;
            if(s){
            window.location.href="/api/items/search/" + s;
            }
            else
                alert("the search field can't be empty"); 
        }
        function home(){
            window.location.href="/";
        }
        window.onload = function() {
        var elements = document.querySelectorAll( '.demo-image' );
        Intense( elements );
        }
    </script>
    <script src="/Flat-UI-master/dist/js/vendor/jquery.min.js"></script>
    <script src="/Flat-UI-master/docs/assets/js/application.js"></script>
    <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
    <script src='/js/intense.js'></script>
    <script src="http://localhost:6001/socket.io/socket.io.js"></script>
</html>