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
        <link href="／Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

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
        <a class="navbar-brand" href="#">bambu.com</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li>
            @if (isset($user) > 0)
                    <!--<p> hello {{$user->name}} </p>-->
                    <a href="/logout" >登出</a>
                @else
                    <a href="/login" >登入</a>
                @endif
            </li>
          <li>
            <a href ="/api/product">发布闲置</a>
            </li>
          <li>
            <a href="#">我的闲置</a>
          </li>
          <li><a href="#aboutUs">about us</a></li>
          <li><div class="navbar-form navbar-right">
              <div class="form-group">
                <input type="text" id="inpu1" name="keyword" class="form-control" placeholder="Search"/>
              </div>
              <button onclick="sb()" class="btn btn-default">搜索</button>
            </form>
            </li>
        </ul>
    </div>
    </div>
</nav>
    
    <div class="row">
            @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="thumbnail" >
                            <img src="images/{{$product->image_file}}" class="img-responsive">
                            <div class="caption">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <h5>{{$product->name}}</h5></div>
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <p>{{$product->image_file}}</p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <p>
                                            <label>￥{{$product->price}}</label></p>
                                    </div>
                                </div>
                                <p>{{$product->description}}</p>
                                <div class="row">
                                    <div class="col-md-6 col-md-offset-3">
                                        <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> 购买</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
    </div>
    <div class="row">
        <ul class="pagination">
            <li><a href="#">&laquo;</a></li>
            <li><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">&raquo;</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-4 col-xs-6">
            
        </div>    
        
    </div>

</div>

<footer class="footer navbar-fixed-bottom" id = "aboutUs">
    <div class="container">
     <p style="color:#f44336"> copyright@2016 bambu.com ICP:</p>
    
    </div>
</footer>
    <script type="text/javascript">
        function sb(){
            window.location.href="api/items/search/" + document.getElementById('inpu1').value;
        }

    </script>
    <script src="/Flat-UI-master/dist/js/vendor/jquery.min.js"></script>
    <script src="/Flat-UI-master/docs/assets/js/application.js"></script>
    </body>
</html>
