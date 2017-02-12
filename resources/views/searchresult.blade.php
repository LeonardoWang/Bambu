<!DOCTYPE html>
<html>
    <head>
        <title>Bambu, your idle items trading app</title>

        <meta charset="utf-8">
        <meta name="baidu-site-verification" content="X5TO9MtQAq" />
        <meta name="description" content="Bambu, your idle items trading app."/>
        <meta name="keywords" content="Bambu, second hand, idle item"/>
        <meta name="robots" content="all" />
        <meta name="author" content="Marc Wang and Leonardo Wang" />
        <meta name="viewport" content="width=100%, initial-scale=1.0, maximum-scale=1.0">

        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="http://localhost:6001/socket.io/socket.io.js"></script>
   
        <!-- Loading Bootstrap -->
        <link href="/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
        <link href="/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <!-- Loading mycss -->
        <link href="/css/mycss.css" rel="stylesheet">
        <link rel="shortcut icon" href="/img/favicon.ico">

        <!-- bambu-color1:#e53935;
        bambu-color2:#f44336;
        grey:#bdc3c7;
    -->
    </head>
    
    <body>
<!--navbar-->
<div style="margin-left:0px;margin-right:0px;">
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
                <li><div class="navbar-form col-xs-2 col-sm-2" style="margin-left:0px;padding-left:21px;">
                    <div class="form-group">
                        <div class="input-group" >
                            <input type="text" id="inpu1" class="form-control" placeholder="Search"/>
                            <span class="input-group-btn">
                                <button onclick="sb()" class="btn"><span class="fui-search"></span></button>
                            </span>
                        </div>
                    </div>
                    </div>
                </li>
               </ul>
            </div><!-- /.navbar-collapse -->
          </nav><!-- /navbar -->
    </div>

<!-- products on the home page -->
@if (isset($products) > 0)
    <div class="container">
        <div class="row" style="width:100%;margin:58px auto 0px auto; padding:auto;">
            <!--{{$i=0}}-->
            @for ($i = 0; $i < count($products);$i++)
            <!--foreach (products as product)-->
                @if ($i < 6)
                    <!--{{$product=$products[$i]}}-->
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="thumbnail">
                            <div class="demo-image" data-image="/api/product/images/{{$product->image_file}}" data-title="{{$product->title}}" data-caption="{{$product->description}}"><img src="/api/product/images/{{$product->image_file}}" class="img-responsive"></div>
                            <div class="caption" style="padding-top:0px;">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div style="color:#9aa4af; overflow:hidden; height:35px;">
                                            <p style="margin:0 0 0 0px;">{{$product->description}}</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8" style="text-align:left;padding-left: 0px;">
                                            <div class="col-lg-1 col-md-1 col-sm-1" style="padding-left:5px;">
                                            <img style="width:20px;" src="/img/icons/svg/clocks.svg"/>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8">
                                            <p style="color:#bdc3c7; font-size:15px; margin-top:2px;">{{substr($product->created_at,0,10)}}<p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-3 col-sm-4" style="text-align:left;">
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
            <!--pagination
            <ul class="col-sm-3 col-md-3 col-lg-2 pagination">
            @for ($i = 1; $i < count($products)/3;$i++)
                <li id="{{$i}}" class="bambu-color1" onclick="turnpage({{$i}})"><a>{{$i}}</a></li>
            @endfor
            </ul>
            -->
        </div>

    <footer class="footer navbar" id = "aboutUs" style="margin: 0px; padding: 0px; width:102.5%; left:-1.5%">
    @if (isset($user) > 0)
    <div id="chatroom" style="position:absolute;bottom:10px;background-color:transparent;display:none;">
        <div class="col-md-12 column">
            <div class="thumbnail" style="height:200px;">
                <div class="col-md-3 caption" id="dialog_userid"></div>
                <div class="col-md-9 caption" id="dialog_message"></div>
            </div>
            <form onsubmit="onSubmit(); return false;">
                <textarea class="form-control thumbnail" id="sendtext" placeholder="please reply here"></textarea>
                <div><input type="submit" class="btn" value="send" /></div>
            </form>
        </div>
    </div>
    <button id="chatroomButton" onclick="toggleChat()" class="btn btn-primary bambu-color1" style="position:absolute;bottom:10px; left:165px;">show</button>
    @endif
    <p style="text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
    </footer>
    </div>
@else
    <div class="container">
        <div class="row" style="margin-top:56px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>

    <footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p style="text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
</footer>
@endif

</body>
<script src="/js/chat.js"></script>
<script src="/js/basic.js"></script>
</html>
