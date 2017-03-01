<!--
other's profile page
-->

@extends('base')

@section('content')

<div style="margin-top:58px;">
    <div class="col-xs-12 col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
        <div class="card card-2">
            <div class="caption">
                <div class="row">
                    <div class="col-md-12">
                        <div style="color:#9aa4af; max-height:650px; overflow-x:visible;">
                            @if(!strlen($user_information->user_image))
                                <img style="width:100px;" src="/img/default_user_profile.jpg" class="img-circle"/>
                            @else
                                <img style="width:100px;" src="/images/{{$user_information->user_image}}" class="img-circle"/>
                            @endif
                        <h6>{{$user_information->name}}'s Profile</h6>
                        <hr>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3" for="name">Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p class="profile">{{$user_information->name}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3" for="sex">Gender</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p class="profile">{{$user_information->sex}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3" for="tel">Phone</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p class="profile">{{$user_information->tel}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3" for="city">City</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p class="profile">{{$user_information->city}}</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 col-sm-3 col-xs-3" for="address">Address</label>
                            <div class="col-md-9 col-sm-9 col-xs-9">
                                <p class="profile">{{$user_information->address}}</p>
                            </div>
                        </div>
                                    <!--<div class="form-group">
                                        <label class="col-md-3" for="rank">Rank</label>
                                            <div class="col-md-9 col-sm-9 col-xs-9">
                                                <input id="rank" name="rank" type="text" value="{{$user_informationuser_information->rank}}" class="form-control input-md" required="">
                                            </div>
                                        </div>
                                    -->
                        <input id="user_id" type="hidden" value="{{$user_information->id}}">
                        <div class="col-offset-3">
                            <div class="form-group">
                                <button id="chat" onclick="createChatRoom({{$user_information->id}})" class="btn btn-product bambu-color1">Chat With {{($user_information->sex=="female")?"Her":"Him"}}</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection