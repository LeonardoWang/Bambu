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
        
<!--navbar-->
<div style="margin-left:0px;margin-right:0px;">
        <nav class="navbar navbar-fixed-top" role="navigation">
            <div class="navbar-header bambu-color1">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
              </button>
              <img id="home" onclick="javascript:window.location.href='/'" src='/img/favicon.png'>
            </div>
            <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">

            <ul class="nav navbar-nav">         
                <li><p style="font-family:Milkshake;top:20px;font-size:24px;margin:5px 24px 5px 12px;">Bambù</p></li>
                <li><div class="navbar-form col-xs-4 col-sm-4" style="margin-left:0px;padding-left:10px;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="inpu1" class="form-control" style="width:250px;" placeholder="Search" onkeydown="enterToSearch(this,event)"/>
                            <span class="input-group-btn">
                            <select id="category" name="category" class="form-control" style="font-family: NexaLight;color:#7f8c8d;border-bottom-right-radius: 6px;border-top-right-radius: 6px;" required="required">
                                <option value="all">All Categories</option>
                                <option value="art">Art & Music</option>
                                <option value="beauty">Beauty, Health & Geocery</option>
                                <option value="book">Book & Study</option>
                                <option value="clothing">Clothing & Fashion</option>
                                <option value="computer">Computer & Electronics</option>
                                <option value="home">Home, Garden & Tools</option>
                                <option value="sports">Sports & Outdoor</option>
                                <option value="toys">Toys & Kids</option>
                            </select>
                            </span>
                            <!--
                            <span class="input-group-btn">
                                <button onclick="sb()" class="btn"><span class="fui-search"></span></button>
                            </span>-->
                        </div>
                    </div>
                    </div>
                </li>
            </ul>
            @if (isset($user) > 0)
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a onclick="chatroom()" class="dropdown-toggle" data-toggle="dropdown"><img id="bell" style="width:24px;" onmouseover="notifOnMouseOver(this)" onmouseout="notifOnMouseOut(this)" src='/img/icons/svg/bell.svg'></a>
                    <!--<ul class="dropdown-menu dropdown-menu-style">
                        <a href="/api/chat_room/MyChatroom"><li class="dropdown-menu-li"><p style="font-size:16px;padding:10px;">CHATROOM</p></li></a>
                    </ul>-->
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right" style="margin-right:30px;">
                <div class="user">
                    <p class="user-name">{{$user->name}}<span class="user-menu"></span></p>
                    <div class="user-nav">
                        <ul style="padding-left:0px; top:0px;">
                            <a href ="/api/product"><li style="color:#7f8c8d;">Post Item<span></span></li></a>
                            <a href="/api/users_information"><li style="color:#7f8c8d;">Personal Info<span class="user-nav-settings"></span></li></a>
                            <a href="/api/product/myProduct"><li style="color:#7f8c8d;">My Items<span class="user-nav-stats"></span></li></a>
                            <a href="/api/trade_requests/my"><li style="color:#7f8c8d;">Trade Requests<span class="user-nav-messages"></span></li></a>
                            <a href="/logout"><li style="color:#7f8c8d;">Sign Out<span class="user-nav-signout"></span></li></a>
                        </ul>
                    </div>
                </div>
            </ul>
            @else
            <ul class="nav navbar-nav navbar-right" style="margin-right:30px;">
                <li>
                    <a href="/login" >Sign In</a>
                </li>
                <li>
                    <a href="/register" >Register</a>
                </li>
                <!--<li><a href="#aboutUs">About us</a></li>-->
            </ul>
            @endif
                
            </div><!-- /.navbar-collapse -->
        </nav><!-- /navbar -->
    </div>

<!-- products on the home page -->
@if (isset($products) > 0)
    <div class="container">
        <div class="row" style="width:100%;margin:58px auto 60px auto; padding:auto;">
            <div class="col-md-2 card card-2" style="text-align:left;background-color:white;border-radius:10px;">
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
            <div class="col-md-10">
            @for ($i = 0; $i < count($products);$i++)
            <!--foreach (products as product)-->
                @if ($i < 12)
                    <!--{{$product=$products[$i]}}-->
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3" align="center">
                        <div class="card card-1">
                        <a href="/api/trade_requests/{{$product->id}}">
                            <img src="/api/product/images/{{$product->image_file}}" class="img-responsive" style="max-height:350px;border-radius:8px;">
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
    <p style="color:#7f8c8d;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
    <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">Homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:support@thebambu.com">contact us</a></p>
</footer>

@else
    <div class="container">
        <div class="row" style="margin-top:56px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>

    <footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p style="color:#7f8c8d;text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">Homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:support@thebambu.com">contact us</a></p>
</footer>
@endif

</body>

<script src="/js/chat.js"></script>
<script src="/js/basic.js"></script>
<script>
$('li.dropdown').mouseover(function() { 
    $(this).addClass('open');}); 
    </script>
</html>


