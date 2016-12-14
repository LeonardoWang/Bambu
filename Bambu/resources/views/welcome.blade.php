<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Bambu, your idle items renting app</title>
        <meta name="description" content="Bambu, your idle items renting app."/>

        <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0">

        <!-- Loading Bootstrap -->
        <link href="../../Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <link href="../../Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">
        <link href="../../Flat-UI-master/docs/assets/css/demo.css" rel="stylesheet">

        <link rel="shortcut icon" href="../../Flat-UI-master/img/favicon.ico">


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
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    
    <body>

    <div class="container">

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">bambu</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="/login">login</a></li>
            <li><a href="#">about us</a></li>
            <li><form class="navbar-form navbar-right" role="search">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search">
              </div>
              <button type="submit" class="btn btn-default">搜索</button>
            </form>
            </li>
        </ul>
    </div>
    </div>
</nav>




       
            <div class="content">
                <div class="title">Bambu</div>
                @if (isset($user) > 0)
                    <p> hello {{$user->name}} </p>
                    <a href="/logout" ><button>logout</button></a>
                @else
                    <a href="/login" ><button>login</button></a>
                @endif
            </div>
        </div>


<footer class="footer navbar-fixed-bottom ">
    <div class="container">
     <p style="color:#f44336">     copyright@2016 Yao Wang & Xupu Wang</p>
    
    </div>
</footer>

    <script src="dist/js/vendor/jquery.min.js"></script>
    <script src="dist/js/vendor/video.js"></script>
    <script src="dist/js/flat-ui.min.js"></script>
    <script src="docs/assets/js/application.js"></script>
    </body>
</html>
