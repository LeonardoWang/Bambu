<!--navbar-->
<div style="margin-left:0px;margin-right:0px;">
    <nav class="navbar navbar-fixed-top" role="navigation">
        <div class="navbar-header bambu-color1">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-01">
                <span class="sr-only">Toggle navigation</span>
            </button>
            <img id="home" onclick="javascript:window.location.href='/'" src='/img/favicon.png'>
            <p style="display:inline-block;font-family:Milkshake;font-size:32px;margin:auto;">Bambù</p>
        </div>
        <div class="collapse navbar-collapse bambu-color1" id="navbar-collapse-01">
            <ul class="nav navbar-nav">
                <li><div class="navbar-form" style="margin-left:0px;padding-left:40px;padding-right:20px;width:400px;">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" id="inpu1" class="form-control" style="width:160px;" placeholder="Search" onkeydown="enterToSearch(this,event)"/>
                            <span class="input-group-btn" style="width:100%;">
                            <select id="category" name="category" class="form-control" style="font-family: NexaLight;color:#7f8c8d;border-bottom-right-radius: 0px;border-top-right-radius: 0px;" required="required">
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
                            <span class="input-group-btn">
                                <button onclick="sb()" class="btn" style="left:-18px;width:40px;border-color: #f2f2f2;background-color: #f2f2f2;"><span class="fui-search"></span></button>
                            </span>
                        </div>
                    </div>
                    </div>
                </li>
            </ul>
            @if (isset($user) > 0)
            <ul class="nav navbar-nav navbar-right" style="padding-left:40px;margin-right:30px;">
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
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown" style="text-align:right;padding-right:20px;">
                    <a onclick="chatroom()" class="dropdown-toggle" data-toggle="dropdown"><img id="bell" style="width:24px;" onmouseover="notifOnMouseOver(this)" onmouseout="notifOnMouseOut(this)" src='/img/icons/svg/bell.svg'></a>
                    <!--<ul class="dropdown-menu dropdown-menu-style">
                        <a href="/api/chat_room/MyChatroom"><li class="dropdown-menu-li"><p style="font-size:16px;padding:10px;">CHATROOM</p></li></a>
                    </ul>-->
                </li>
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