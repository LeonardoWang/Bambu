<!--
myprofile page
-->

@extends('base')

@section('content')
<div style="margin-top:58px;">
            @if (isset($comments)>0)
                <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-2" style="max-height:800px;overflow-y:auto;">
                        @foreach ($comments as $comment)
                    <div class="row">
                        
                            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2">
                                <a href="/api/user/{{$comment->user_id}}/info/">
                                    <img class="img-circle" src="{{$comment->user_image}}" style="width:60px;">
                                </a>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="text-align:left;">
                                <div class="thumbnail" >
                                <div class="caption" style="padding-top:0px;">
                                    <div class="row">
                                        <div class="col-lg-7 col-md-7 col-sm-6 col-xs-7" style="text-align:left;">
                                            <p style="font-size:12px; margin:0 0 0 0px;"><b><a href="/api/user/{{$comment->user_id}}/info/" class = "ba">{{$comment->user_name}}</a></b><br>
                                                {{$comment->message}}</p>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-4 col-xs-4" style="text-align:left;">
                                            <p style="color:#bdc3c7; font-size:10px; margin-top:0px;">{{substr($comment->created_at,0,10)}}<p>
                                            <p style="color:#f44336; font-size:13px; margin:0 0 0 0px;">￥ {{$comment->price}}</p>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1" style="padding-top:18px;margin-left:0px;left:-20px">
                                <button onclick="javascript:window.location.href='/api/trade_requests/{{$comment->item_id}}'" class="btn btn-sm bambu-color1">Check it out</button>
                            </div>
                    </div>
                @endforeach
                </div>
                                               
            @else
                <div class="thumbnail" >
                    <div class="caption">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <p>No any comments yet</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
</div>
@endsection