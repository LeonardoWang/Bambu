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
              <img id="home" onclick="javascript:window.location.href='/'" src='/img/favicon.ico'>
            </div>
            <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">

            <ul class="nav navbar-nav">         
                <li><div class="navbar-form col-xs-4 col-sm-4" style="margin-left:0px;padding-left:10px;">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn">
                            <select id="category" name="category" class="form-control" style="font-size:12px;border-bottom-left-radius: 6px;border-top-left-radius: 6px;" required="required">
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
                            <input type="text" id="inpu1" class="form-control" style="width:250px;" placeholder="Search"/>
                            <span class="input-group-btn">
                                <button onclick="sb()" class="btn"><span class="fui-search"></span></button>
                            </span>
                        </div>
                    </div>
                    </div>
                </li>
            </ul>
                @if (isset($user) > 0)
               <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="bell" style="width:24px;" onmouseover="notifOnMouseOver(this)" onmouseout="notifOnMouseOut(this)" src='/img/icons/svg/bell.svg'></a>
                            <ul class="dropdown-menu">
                                <li>
                                     <a href="/api/trade_requests/my">Trade Requests</a>
                                </li>
                                <li>
                                     <a onclick="chatroom()">Chat Center</a>
                                </li>
                                <!--<li>
                                     <a href="/api/chat_room/MyChatroom">Chat history</a>
                                </li>-->
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="mailto:brucewayne@pku.edu.cn">Contact Us</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img id="personal-card" style="width:24px;" onmouseover="notifOnMouseOver(this)" onmouseout="notifOnMouseOut(this)" src='/img/icons/svg/personal-card.svg'></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="/api/product/myProduct">My Items</a>
                                </li>
                                <li>
                                     <a href="/api/users_information">Personal Info</a>
                                </li>
                                <li class="divider">
                                </li>
                                <li>
                                     <a href="/logout" >Sign Out</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    @endif
                <ul class="nav navbar-nav navbar-right">
                <li>
                @if (isset($user) > 0)
                    <a href="/api/users_information"> Hello, {{$user->name}} </a>
                </li>
                <li>
                    <a href ="/api/product">Post Item</a>
                @else
                    <a href="/login" >Sign In</a>
                </li>
                <li>
                    <a href="/register" >Register</a>
                @endif
                </li>
                
                <!--<li><a href="#aboutUs">About us</a></li>-->
                
               </ul>
               
            </div><!-- /.navbar-collapse -->
        </nav><!-- /navbar -->
    </div>

<!-- products on the home page -->
@if (isset($products) > 0)
    <div class="container">
        <div class="row" style="width:100%;margin:58px auto 60px auto; padding:auto;">
            <!--{{$i=0}}-->
            @for ($i = 0; $i < count($products);$i++)
            <!--foreach (products as product)-->
                @if ($i < 12)
                    <!--{{$product=$products[$i]}}-->
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3" align="center">
                        <a href="/api/trade_requests/{{$product->id}}">
                            <img src="/api/product/images/{{$product->image_file}}" class="img-responsive" style="max-height:350px;">
                        <div class="caption" style="padding-top:0px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="color:#9aa4af; overflow:hidden; max-height:60px;">
                                        <p style="padding:0px;margin:0px;">{{$product->title}}</p>
                                        <p style="padding:0px;margin:0px;">￥<label style="color:#f44336; font-weight:900;">{{$product->price}}</label></p>
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

<footer class="footer navbar navbar-fixed-bottom" id = "aboutUs">
    @if (isset($user) > 0)
    <input type="hidden" id="userName" value="{{$user->name}}">
    <input type="hidden" id="user_id" value="{{$user->id}}">
    <div id="chatroom" style="position:absolute;bottom:10px;background-color:transparent;">
        <!--chatroom added here-->
    </div>
    @endif
    <p style="font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
    <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">Homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
</footer>

@else
    <div class="container">
        <div class="row" style="margin-top:56px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>

    <footer class="footer navbar-fixed-bottom" id = "aboutUs">
     <p style="text-align:center;font-size:11px;margin-bottom:0px;"> copyright@Onesia Group ltd. All Rights Reserved<br>京ICP备15050380-2<br>
        <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="/">Homepage</a> | <a style="font-weight:inherit;color:inherit;background-color:inherit;" href="mailto:brucewayne@pku.edu.cn">contact us</a></p>
</footer>
@endif

</body>

<script src="/js/chat.js"></script>
<script src="/js/basic.js"></script>
</html>


