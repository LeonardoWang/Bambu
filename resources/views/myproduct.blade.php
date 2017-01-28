<!--
trade confirmation page
-->

@extends('base')

@section('content')

@if (isset($products) > 0)
            @foreach ($products as $product)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="thumbnail" >
                            <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                            <img src="/api/product/images/{{$product->image_file}}" class="img-responsive">
                            
                            <div class="caption">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div style="color:#9aa4af; overflow:hidden; height:35px;">
                                            <p style="margin:0 0 0 0px;">{{$product->description}}</p>
                                        </div>
                                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-6" style="text-align:left;padding-left: 0px;">
                                            <div class="col-lg-1 col-md-1 col-sm-1" style="padding-left:5px;">
                                            <img style="width:20px;" src="/img/icons/svg/clocks.svg"/>
                                            </div>
                                            <div class="col-lg-9 col-md-9 col-sm-9">
                                            <p style="color:#bdc3c7; font-size:15px; margin-top:5px;">{{substr($product->created_at,0,10)}}<p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6" style="text-align:left;">
                                            <p style="color:#f44336; margin-top:0px;">￥{{$product->price}}</p>
                                        </div>
                                        <!--<h5>{{$product->title}}</h5>-->
                                        <!--<p>{{$product->image_file}}</p>-->
                                        <!--<p>created by <a href="#" class="bambu-color1">{{$product->user_name}}</a></p>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-offset-3">
                                        <a href="/api/items/{{$product->id}}/delete" class="btn btn-success btn-product bambu-color1"><span class="fa fa-shopping-cart"></span> Delete it</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
            <!-- pagination
            <ul class="col-sm-12 col-md-12 col-lg-12 pagination">
            @for ($i = 1; $i < count($products)/3;$i++)
                @if($i==1)
                <li class="bambu-color1"><a>{{$i}}</a></li>
                @else
                <li><a>{{$i}}</a></li>
                @endif
            @endfor
            </ul>
            -->
@else
    <div class="container">
        <div class="row" style="margin-top:56px;">
            <h1>Sorry,no available items yet.</h1>
        </div>
    </div>
@endif

@endsection