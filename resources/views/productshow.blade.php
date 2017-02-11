<!--
product show page
-->

@extends('base')

@section('content')
<div style="margin-top:60px">
    @if (isset($products)==1)
        @foreach ($products as $product)
            <div class="col-lg-4 col-lg-offset-1 col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2">
                <div>
                    <div class="thumbnail" >
                        <div class="demo-image" data-image="/api/product/images/{{$product->image_file}}" data-title="{{$product->title}}" data-caption="{{$product->description}}">
                            <img src="/api/product/images/{{$product->image_file}}" class="img-responsive" style="max-height:600px;">
                        </div>
                        <div class="caption">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="text-align:center;">
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                        <p style="color:#f44336;">￥{{$product->price}}</p>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-8 col-xs-9 col-lg-offset-2 col-md-offset-2 col-sm-offset-1">
                                        <div class="col-lg-8 col-md-9 col-sm-10 col-xs-9">
                                        <p style="text-align:right;font-size:15px;">seller :  <a href="/api/user/{{$product->user_id}}/info/" class = "ba">{{$product->user_name}}</a></p>
                                        </div>
                                        @if ($user->id != $product->user_id)
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                        <img onclick="createChatRoom({{$product->user_id}})" style="width:35px;cursor:pointer;" src="/img/icons/svg/chat.svg"/>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <hr style="margin:0px;">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div style="overflow: auto; max-height:180px;"><p style="font-size:15px;">{{$product->description}}</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-4 col-lg-offset-1 col-md-6 col-md-offset-0 col-sm-8 col-sm-offset-2">
                @if ($user->id != $product->user_id)

                <form method="post" action="/api/trade_request_making" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <div class="form-group">               
                        <label class="col-md-12 control-label" style="font-size:24px; text-align:center;"><b>{{$product->title}}</b>
                    </label>
                    </div>
                    <!-- Text input-->
                    <div class="form-group">               
                        <label class="col-md-3 control-label">Price</label>
                        <div class="col-md-9">
                            <p style="margin:0 0 0 0px; color:#f44336;">￥{{$product->price}}</p>
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

                    <input name="user_name" type="hidden" value="{{$user->name}}">
                    <input name="user_id" type="hidden" value="{{$user->id}}">
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
                @else

                <form method="POST" action="product/addProduct" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="name">Name</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="name" name="title" type="text" value="{{$product->title}}" class="form-control input-md" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="textarea">Description</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="description" name="description" value="{{$product->description}}" class="form-control" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="price">Price</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="price" name="price" type="text" value="￥ {{$product->price}}" class="form-control input-md" required="required">

                        </div>
                    </div>
                    <!-- amount
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="amount">Amount</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="amount" name="amount" type="text" placeholder="amount"  class="form-control input-md" required="required">

                        </div>
                    </div>
                    -->
                    <!--
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="file">One picture for item</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="file" name="image" class="form-control input-md" type="file"> multiple="true"
                        </div>
                    </div>!-->
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="category">Category</label>
                        <div class="col-sm-8 col-md-8">
                            <select id="category" name="category" class="form-control input-md" default="{{$product->category}}" required="required">
                                <option value="art">Art & Music</option>
                                <option value="beauty">Beauty, Health & Geocery</option>
                                <option value="book">Book & Study</option>
                                <option value="clothing">Clothing & Fashion</option>
                                <option value="computer">Computer & Electronics</option>
                                <option value="home">Home, Garden & Tools</option>
                                <option value="sports">Sports & Outdoor</option>
                                <option value="toys">Toys & Kids</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-6">
                            <button id="submit" name="submit" class="btn btn-primary bambu-color1">modify your item</button>
                        </div>
                    </div>

                </fieldset>

            </form>
            <hr style="margin-top:0px;">
                @endif

                <div class="col-md-12" style="max-height:226px;overflow-y:auto;">
                    @if (isset($comments)>0)
                        <p>Comments to this item:</p>
                        @foreach ($comments as $comment)
                        <div class="row" id="comment{{$comment->id}}">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <a href="/api/user/{{$comment->user_id}}/info/">
                                    <img class="img-circle" src="{{$comment->user_image}}" style="max-width:80px;">
                                </a>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9" style="text-align:left;">
                                <div class="thumbnail" >
                                <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                                <div class="caption" style="padding-top:0px;">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-7" style="text-align:left;">
                                            <p style="margin:0 0 0 0px;"><b><a href="/api/user/{{$comment->user_id}}/info/" class = "ba">{{$comment->user_name}}</a></b><br>
                                                {{$comment->message}}</p>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-5" style="text-align:left;">
                                            <p style="color:#bdc3c7; font-size:10px; margin-top:0px;">{{substr($comment->created_at,0,10)}}<p>
                                            <p style="color:#f44336; margin:0 0 0 0px;">￥ {{$comment->price}}</p>
                                            @if ($user->id == $product->user_id || $user->id == $comment->user_id)
                                            <button onclick="deleteComment({{$comment->id}})" class="btn btn-sm"> delete it</button>
                                            @endif
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
</div>
@endsection
