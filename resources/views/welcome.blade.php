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
<!--
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="container-fluid" style="background-color:#e53935;">
        
        <ul class="nav navbar-nav">
            <li>
                <img id="home" onclick="home()" src='/img/favicon.ico' style="width:50px;"></img></li>
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
    </div>
</nav>
-->

@if (isset($products) > 0)
    <div class="container" style="width:100%;">
        <div class="row" style="width:100%;margin-top:58px;padding-bottom:80px;">
            <!--{{$i=0}}-->
            @for ($i = 1; $i < count($products);$i++)
            <!--foreach (products as product)-->
                @if ($i<=12)
                    <!--{{$product=$products[$i]}}-->
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3">
                        <div class="thumbnail">
                            <div class="demo-image" data-image="/api/product/images/{{$product->image_file}}" data-title="{{$product->title}}" data-caption="{{$product->description}}"><img src="/api/product/images/{{$product->image_file}}" class="img-responsive"></div>
                            <div class="caption" style="padding-top:0px;">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div style="color:#9aa4af; overflow:hidden; height:35px;">
                                            <p style="margin:0 0 0 0px;">{{$product->description}}</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8" style="text-align:left;padding-left: 0px;">
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-left:5px;">
                                            <img style="width:20px;" src="/img/icons/svg/clocks.svg"/>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <p style="color:#bdc3c7; font-size:15px; margin-top:2px;">{{substr($product->created_at,0,10)}}<p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4" style="text-align:left;">
                                            <p style="color:#f44336; margin-top:0px;">￥{{$product->price}}</p>
                                        </div>
                                        <!--<p>{{$product->image_file}}</p>-->
                                        <!--<p>created by <a href="#" class="bambu-color1">{{$product->user_name}}</a></p>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-offset-3">
                                        <a href="/api/trade_requests/{{$product->id}}" class="btn btn-success btn-product bambu-color1"><span class="fa fa-shopping-cart"></span> I want it!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
            <!--pagination not used in homepage
            <ul class="col-sm-3 col-md-3 col-lg-2 pagination">
            @for ($i = 1; $i < count($products)/3;$i++)
                <li id="{{$i}}" class="bambu-color1" onclick="turnpage({{$i}})"><a>{{$i}}</a></li>
            @endfor
            </ul>
            -->
        </div>
    </div>
@else
    <div class="container">
        <div class="row" style="margin-top:56px;margin-bottom:80px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>
@endif

<footer class="footer navbar-fixed-bottom" id = "aboutUs">
    <div style="position:absolute;background-color:transparent;bottom:20px;">
            <div class="col-md-12 column">
               <div class="thumbnail" style="height:200px;">
                   <div class="col-md-3 caption" id="dialog_userid"></div>
                   <div class="col-md-9 caption" id="dialog_message"></div>
               </div>
               <form onsubmit="onSubmit(); return false;">
                    <textarea class="form-control thumbnail" id="sendtext" placeholder="please reply here"></textarea>
                    <div class="say-btn"><input type="submit" class="btn btn-default" value="发表" /></div>
               </form>
            </div>
        </div>
    <p style="text-align:center;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:bambu@pku.edu.cn">contact us</a></p>
</footer>

</body>
    <script src="/Flat-UI-master/dist/js/vendor/jquery.min.js"></script>
    <script src="/Flat-UI-master/docs/assets/js/application.js"></script>
    <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
    <script src='/js/intense.js'></script>
    <script src="http://localhost:6001/socket.io/socket.io.js"></script>
    <script type="text/javascript">
        /*function turnpage(id){

            window.location.href="/";
        }*/

        var socket = io('http://localhost:6001');
        socket.on('connection', function (data) {
            console.log(data);
        });
        socket.on('2:App\\Events\\SomeEvent', function(message){
        console.log(message);
        document.getElementById("dialog_userid").append(message.user_id);
        document.getElementById("dialog_message").append(message.message);
        });
        console.log(socket);
    
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

        function onSubmit(){
            document.getElementById("dialog_userid").append("marc");
            document.getElementById("dialog_message").append(document.getElementById("sendtext").value);
        }

    </script>
</html>