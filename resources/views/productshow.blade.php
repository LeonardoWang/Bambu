<!--
trade confirmation page
-->

@extends('base')

@section('content')
    @if (isset($products)==1)
        @foreach ($products as $product)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div style="padding-top:60px;"><h5>item info</h5></div>
                <div>
                    <div class="thumbnail" >
                        <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                        <img src="/api/product/images/{{$product->image_file}}" class="img-responsive">
                            
                        <div class="caption">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>name:{{$product->title}}</p>
                                    <p>price:￥{{$product->price}}</p>
                                    <p>seller:{{$product->user_id}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-4 col-sm-offset-1" style="margin-top:6%">
                <form method="post" action="/api/trade_request_making" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label" for="name">Item price</label>
                        <div class="col-sm-8 col-md-9">
                            <p>￥{{$product->price}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">Your offer</label>
                        <div class="col-md-9">
                            <input id="price" name="price" type="text" placeholder="￥" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="itemfortrade">And/Or add item for trade</label>
                        <div class="col-md-9">
                            <input id="itemfortrade" name="itemfortrade" type="text" placeholder="your item" class="form-control input-md">
                            <!--<input id="file" name="image" class="form-control input-md" type="file" accept="image/jpeg, image/png">-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="message">Leave a message</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="message" name="message" placeholder="any more specific about your trade offer?"></textarea>
                        </div>
                    </div>

                    <input name="user_id" type="hidden" value="{{$user->name}}">
                    <input name="item_id" type="hidden" value="{{$product->id}}">

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div style="padding-bottom:70px;"><div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary bambu-color1">trade</button>
                        </div>
                        </div>
                    </div>
                </fieldset>
                </form>
                <hr style="margin-top:-30px;">
                <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom:70px">
                    @if (isset($comments)>0)
                        <h6>Comments to this item:</h6>
                        @foreach ($comments as $comment)
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align:left;">
                                <h6 style="margin-top:0px;">{{$comment->user_id}}</h6>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="text-align:left;">
                                <div class="thumbnail" >
                                <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                                <div class="caption">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-7 col-xs-6" style="text-align:left;">
                                            <p style="margin:0 0 0 0px;">{{$comment->message}}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-5 col-xs-6" style="text-align:left;">
                                            <p style="color:#bdc3c7; font-size:10px; margin-top:0px;">{{$comment->updated_at}}<p>
                                            <p style="color:#f44336; margin:0 0 0 0px;">￥ {{$comment->price}}</p>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="thumbnail" >
                            <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                            <div class="caption">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <p>Not any comment yet</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endsection
