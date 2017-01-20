<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bambu, your idle items renting app</title>
        <meta name="description" content="Bambu, your idle items renting app."/>

        <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="/public/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="/public/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <link rel="shortcut icon" href="/public/img/favicon.ico">


        <title>Bambu</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                
            }
  
            a,a:hover,a:focus,a:active,a:visited {
                color: white;
                background-color:#e53935;
                border-color:#e53935;
                }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
                width:100;
            }


            .content {
                text-align: center;
                display: inline-block;
            }

            .bambu-color1,.bambu-color1:hover,.bambu-color1:after {
                background-color:#e53935;
                border-color:#e53935;
            } 

            .bambu-color2{
                background-color:#f44336;
                border-color:#f44336;
            } 
            .bambu-color2:hover{
                background-color:#f44336;
                color:white;
            }

            .btn, .btn:hover, .btn:focus, .btn:active{
                color:#ffffff;
                background-color: #e53935;
                border-color: #e53935;
            }

            .btn:visited{
                color:#ffffff;
                background-color: #e53935;
                border-color: #e53935;
            }

        </style>
        <!-- bambu-color1:#e53935;
        bambu-color2:#f44336;
    -->
    </head>
    <body>
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container-fluid" style="background-color:#e53935;">
        
        <ul class="nav navbar-nav">
            <li>
                <img onclick="home()" src='/public/img/favicon.ico' style="width:50px;"></img></li>
            <li>
            @if (isset($user) > 0)
                    <a href="#"> hello, {{$user->name}} </a></li><li>
                    <a href="/logout" >logout</a>
                @else
                    <a href="/login" >login</a>
                @endif
            </li>
          <li>
            <a href ="/public/api/product">post items</a>
            </li>
          <li>
            <a href="#">my items</a>
          </li>
          <li><a href="#aboutUs">about us</a></li>
          <li><div class="navbar-form navbar-right">
              <div class="form-group">
                <input type="text" id="inpu1" name="keyword" class="form-control" placeholder="Search"/>
              </div>
              <button onclick="sb()" class="btn btn-primary bambu-color1" style="background-color:#f44336">search</button>
            </div>
            </li>
    </div>
</nav>

<div class="container" style="width:100%;">
                <div class="row">
                    @yield('content')
                </div>
            </div>
    </body>
</html>
