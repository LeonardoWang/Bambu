<!--
myprofile page
-->

@extends('base')

@section('content')
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3" style="margin-top:60px;">
        <div class="thumbnail" >
            <div class="caption">
               <!-- <form method="post" action="/api/users/{{$user->id}}" class="form-horizontal" enctype="multipart/form-data" role="form">
                    <fieldset>-->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
                                <div style="color:#9aa4af; max-height:600px;">
                                    <img style="width:80px;" src="/img/icons/svg/clipboard.svg"/>
                                    <h6>Profile</h6>
                                    <hr>
                                    <div class="form-group">
                                        @if(!strlen($user_information->user_image))
                                            <img style="width:100px;" src="/img/default_user_profile.jpg"/>
                                        @else
                                            <img style="width:100px;" src="{{$user_information->user_image}}"/>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-3 control-label" for="name">Name</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <p class="profile">{{$user->name}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-3 control-label" for="tel">Phone</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <p class="profile">{{$user->tel}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-3 control-label" for="location">Location</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <p class="profile">{{$user_information->location}}</p>
                                        </div>
                                    </div>
                                    <!--<p>{{$user_information->sex}}</p>-->
                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-3 control-label" for="sex">Gender</label>
                                        <div class="col-md-9 col-sm-9 col-xs-9">
                                            <p class="profile">{{$user_information->sex}}</p>
                                        </div>
                                    </div>
                                    <!--<div class="form-group">
                                        <label class="col-md-3 control-label" for="rank">Rank</label>
                                            <div class="col-md-9">
                                                <input id="rank" name="rank" type="text" value="{{$user_information->rank}}" class="form-control input-md" required="">
                                            </div>
                                        </div>
                                    -->
                                    <div class="col-offset-3">
                                        <div class="form-group">
                                            <button id="submit" name="submit" class="btn btn-product bambu-color1">leave him/her a message</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                <!--    </fieldset>
                </form>-->
            </div>
        </div>
    </div>
@endsection