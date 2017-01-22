<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bambu, your idle items renting app</title>
        <meta name="description" content="Bambu, your idle items renting app."/>

        <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <link rel="shortcut icon" href="/img/favicon.ico">


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
                font-family: sans-serif, Helvetica, Arial, 'Microsoft Yahei'; 
            }
            
            img{
                max-width: 500px;
                max-height: 500px;
            }

            a,a:hover,a:focus,a:active,a:visited {
                color: white;
                background-color:#e53935;
                border-color:#e53935;
                }

            a:focus,a:active{
                background: hsla(0,0%,7%,0.5);
                background-color: rgba(17,17,17,0.5);
                background-image: none;
                background-clip: border-box;
                background-position-x: 0%;
                background-position-y: 0%;
            }


            label{
                line-height: 1;
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

            .form-control:focus{
                border-color: #e53935;
            }

            .panel,.panel-info, .panel-title,.panel-heading{
                border-color: #888888;
                background-color: white;   
            }

            #file {
                cursor: pointer;
                position: relative;
                display: inline-block;
                background: #white;
                border: 2px solid #b2bcc5;
                border-radius: 4px;
                padding: 0px 10px;
                overflow: hidden;
                color: #34495e;
                text-decoration: none;
                text-indent: 0;
                line-height: 20px;
            }

            #file:hover,#file:active,#file:focus {
                border-color: #e53935;
                color: #004974;
                text-decoration: none;
            }
            
            .navbar-toggle::before{
                color:white;
            }
            .navbar-toggle:hover::before, .navbar-toggle:focus::before{
                color:#bdc3c7;
            }


            #home{
                width:53px;
                cursor: pointer;
            }
        </style>
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
              <img id="home" onclick="home()" src='/img/favicon.ico'></img>
            </div>
            <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">
              <ul class="nav navbar-nav">
                <li>
                @if (isset($user) > 0)
                    <a href="#"> hello, {{$user->name}} </a></li><li>
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

<div class="container" style="width:100%;">
                <div class="row">
                    @yield('content')
                </div>
            </div>

<footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p style="text-align:center;"> copyright@2016 Bambu. All Rights Reserved<br>京ICP备15050380-2<br>
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
    </script>
    <script src="/Flat-UI-master/dist/js/vendor/jquery.min.js"></script>
    <script src="/Flat-UI-master/docs/assets/js/application.js"></script>
    <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
</html>
