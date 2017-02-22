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
        <script src="/js/sms.js"></script>
        <script src="/js/basic.js"></script>
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
                <ul class="nav navbar-nav navbar-right" style="margin-right:30px;">
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

<div class="container" style="width:100%;">
    <div class="row" style="width:100%;margin:58px auto 0px auto; padding:auto;">
        @yield('content')
    </div>
</div>

</body>
</html>