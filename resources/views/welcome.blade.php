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
        <script src="http://thebambu.com:6001/socket.io/socket.io.js"></script>

        <!-- Loading Bootstrap -->
        <link href="/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Loading Flat UI -->
        <script src="/Flat-UI-master/dist/js/flat-ui.min.js"></script>
        <link href="/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

        <!-- Loading mycss -->
        <link href="/css/mycss.css" rel="stylesheet">
        <link rel="shortcut icon" href="/img/favicon.ico">

    </head>
    <body>

@extends('navbar')

<!-- products on the home page -->
@if (isset($products) > 0)
    <div class="container">
        <div class="row" style="width:100%;margin:58px auto 60px auto; padding:auto;">
            <div id="index-category" class="col-md-3 col-md-offset-0 col-lg-3 col-lg-offset-0 card card-2" style="text-align:left;background-color:white;border-radius:10px;margin-bottom:30px;">
                <h6 style="font-family:NexaBold;">Categories</h6>
                   <p><!--All Categories<br>-->
                   <a style="color:#34495e;" href="/items/CSearch/art/">Art & Music</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/beauty/">Beauty, Health & Geocery</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/book/">Book & Study</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/clothing/">Clothing & Fashion</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/computer/">Computer & Electronics</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/home/">Home, Garden & Tools</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/sports/">Sports & Outdoor</a><br>
                   <a style="color:#34495e;" href="/items/CSearch/toys/">Toys & Kids</a><br>
                   </p>               
            </div>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">
            @for ($i = 0; $i < count($products);$i++)
            <!--foreach (products as product)-->
                @if ($i < 12)
                    <!--{{$product=$products[$i]}}-->
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3" align="center">
                        <div class="card card-1">
                        <a href="/api/trade_requests/{{$product->id}}">
                            <img src="/images/{{$product->image_file}}" class="img-responsive" style="max-height:350px;border-radius:8px;">
                        <div class="caption" style="padding-top:0px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="color:#9aa4af; overflow:hidden; max-height:80px;text-align:left;">
                                        <p style="padding:0px 0px 0px 20px;margin:0px;font-family:NexaBold; font-size:17px;color:#34495e">{{$product->title}}<br>
                                        <label style="font-family:NexaBold; font-size:18px;color:#f44336; font-weight:900;">￥{{$product->price}}</label></p>
                                    </div>
                                    <!--
                                    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8" style="text-align:left;">
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-left:5px;">
                                            <img style="width:20px;" src="/img/icons/svg/clocks.svg"/>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <p style="color:#bdc3c7; font-size:15px; margin-top:2px;">{{substr($product->created_at,0,10)}}<p>
                                        </div>
                                    </div>
                                        
                                    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4" style="text-align:left;">
                                        <p style="color:#f44336; margin-top:0px;">￥{{$product->price}}</p>
                                    </div>-->
                                    <!--<p>created by <a href="#" class="bambu-color1">{{$product->user_name}}</a></p>-->
                                </div>
                            </div>
                        </div>
                        </a>
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
    </div>

<footer class="footer navbar navbar-fixed-bottom" id = "aboutUs">
    @if (isset($user) > 0)
    <input type="hidden" id="userName" value="{{$user->name}}">
    <input type="hidden" id="user_id" value="{{$user->id}}">
    <div id="chatroom" style="position:absolute;bottom:10px;">
        <!--chatroom added here-->
        <div id="chatroom_user"></div>
     </div>
    @endif
    <p id = "footerp1" style="color:#7f8c8d;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
    <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">Homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:support@thebambu.com">contact us</a></p>
</footer>

@else
    <div class="container">
        <div class="row" style="margin-top:56px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>

    <footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p id = "footerp1" style="color:#7f8c8d;text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">Homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:support@thebambu.com">contact us</a></p>
</footer>
@endif

</body>

<script src="/js/chat.js"></script>
<script src="/js/basic.js"></script>
<!--<script>
$('li.dropdown').mouseover(function() { 
    $(this).addClass('open');}); 
</script>-->
</html>


