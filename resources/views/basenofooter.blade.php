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
        <script src='/js/intense.js'></script>
   
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

<div class="container" style="width:100%;">
    <div class="row" style="width:100%;margin:58px auto 0px auto; padding:auto;">
        @yield('content')
    </div>
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
    
</div>

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

        var clock = '';
        var nums = 30;
        var btn;

        function sendSMS(thisBtn){
        btn = thisBtn;
        btn.disabled = true; //将按钮置为不可点击
        btn.innerHTML = 'resend after ' + nums + ' s';
        clock = setInterval(doLoop, 1000); //一秒执行一次

        var iphone=$("#tel").val();
        //console.log(iphone);
        $.ajax({
            type:"get",
            url:'/smscode',
            data:{'iphone':iphone},

            success:function(msg){
                console.log(msg);
                document.getElementById("code").value = msg.substr(0,4);
                if(msg.substr(13,3)=='100'){
                    alert('SMS code has sent!');
                }else{
                    alert('SMS code sent failed, check your network.');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {  //#3这个error函数调试时非常有用，如果解析不正确，将会弹出错误框
                console.log(XMLHttpRequest);
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus); // paser error;
            },
        });
        }

        function doLoop()
        {
            nums--;
            if(nums > 0){
                btn.innerHTML = 'resend after ' + nums + ' s';
            }else{
                clearInterval(clock); //清除js定时器
                btn.disabled = false;
                btn.innerHTML = 'send code';
                nums = 30; //重置时间
            }
        }

    </script>
</html>