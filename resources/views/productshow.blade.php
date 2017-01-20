@extends('base')

@section('content')
            <div class="col-lg-6 col-md-12 col-xs-6">

                @foreach ($products as $product)
                        <div class="thumbnail" >
                            <img src="images/{{$product->image_file}}" class="img-responsive">
                            <div class="caption">
                                    <div class="col-lg-4 col-md-6 col-xs-6">
                                        <h3>{{$product->name}}</h3>
                                        <!--<h3>{{$product->image_file}}</h3>-->
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-xs-6 price">
                                        <h3>
                                            <label>￥{{$product->price}}</label></h3>
                                    </div>
                                <p>{{$product->description}}</p>
                                    <div class="col-lg-4 col-md-6 col-md-offset-3">
                                        <a href="/addProduct/{{$product->id}}" class="btn btn-success btn-product"><span class="fa fa-shopping-cart"></span> 购买</a></div>
                            </div>
                        </div>
                @endforeach
            </div>
@endsection
