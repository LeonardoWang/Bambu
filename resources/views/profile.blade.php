<!--
other's profile page
-->

@extends('base')

@section('content')

<div style="margin-top:58px;">
    <div style="width:100%;" class="card card-2">
        <div class="caption">
                <div style="color:#9aa4af; overflow-x:visible;overflow-y:auto;">
                        @if($user_information->user_image=='/img/default_user_profile.jpg')
                            <img style="width:100px;" src="{{$user_information->user_image}}" class="img-circle"/>
                        @else
                            <img style="width:100px;" src="/images/{{$user_information->user_image}}" class="img-circle"/>
                        @endif
                        <h6 >{{$user_other->name}}</h6>
                        <p >{{$user_information->city}}</p>
                        <button id="chat" onclick="createChatRoom({{$user_information->id}})" class="btn btn-xs bambu-color1">Chat With {{($user_information->sex=="female")?"Her":"Him"}}</button>
                        <!--{{$user_information->sex}}-->
                        <!--<div class="form-group">
                            <label class="col-md-3" for="rank">Rank</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <input id="rank" name="rank" type="text" value="{{$user_information->rank}}" class="form-control input-md" required="">
                            </div>
                        </div>-->
                        <input id="user_id" type="hidden" value="{{$user_information->id}}">

            </div>
        </div><!--caption-->
    </div><!--card-->

    @if (isset($products) > 0)
        @foreach ($products as $product)
            <div class="col-xs-6 col-sm-4 col-md-3 col-lg-3 card card-1" align="center">
                    <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                    <a href="/api/trade_requests/{{$product->id}}">
                    <img src="/images/{{$product->image_file}}" class="img-responsive" style="max-height:350px;border-radius:8px;">
                    </a>
                    <div class="caption">
                            <div style="color:#9aa4af; overflow:hidden; max-height:80px;text-align:left;">
                                <p style="padding:0px 0px 0px 20px;margin:0px;font-family:NexaBold; font-size:17px;color:#34495e">{{$product->title}}<br>
                                <label style="font-family:NexaBold; font-size:18px;color:#f44336; font-weight:900;">￥{{$product->price}}</label></p>
                            </div>
                    </div>
            </div>
        @endforeach
    @endif

</div>
@endsection