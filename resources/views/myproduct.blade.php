<!--
trade confirmation page
-->

@extends('base')

@section('content')

<div style="margin-top:58px;">
@if (isset($products) > 0)
            @foreach ($products as $product)
                    <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3" align="center">
                        <div class="card card-1">
                            <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                            <a href="/api/trade_requests/{{$product->id}}">
                            <img src="images/{{$product->image_file}}" class="img-responsive" style="max-height:350px;border-radius:8px;">
                            </a>
                            <div class="caption">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p style="padding:0px 0px 0px 20px;margin:0px;font-family:NexaBold; font-size:17px;color:#34495e">{{$product->title}}</p>
                                        <div style="color:#9aa4af; overflow:hidden; max-height:80px;text-align:left;">
                                            <p style="margin:0 0 0 0px;">{{$product->description}}</p>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-8 col-xs-8" style="text-align:left;padding-left: 0px;">
                                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-left:5px;">
                                            <img style="width:20px;" src="/img/icons/svg/clocks.svg"/>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                            <p style="color:#bdc3c7; font-size:15px; margin-top:5px;">{{substr($product->created_at,0,10)}}<p>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-4" style="text-align:left;">
                                            <label style="font-family:NexaBold; font-size:18px;color:#f44336; font-weight:900;">￥{{$product->price}}</label>
                                        </div>
                                        <!--<h5>{{$product->title}}</h5>-->
                                        <!--<p>{{$product->image_file}}</p>-->
                                        <!--<p>created by <a href="#" class="bambu-color1">{{$product->user_name}}</a></p>-->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-offset-3">
                                        <a href="javascript:if(confirm('Are you sure to delete it?'))location='/api/items/{{$product->id}}/delete'" class="btn btn-success btn-product bambu-color1"><span class="fa fa-shopping-cart"></span> Delete it</a></div>
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
    <div class="col-md-12">
            <h1>Sorry,no available items yet.</h1>
    </div>
@endif
</div>

@endsection