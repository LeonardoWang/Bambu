<!--
myprofile page
-->

@extends('base')

@section('content')
                  <div class="col-sm-12 col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
                        <div class="thumbnail" >
                            <div class="caption">
                                <form method="post" action="/api/users/{{$user->id}}" class="form-horizontal" enctype="multipart/form-data" role="form">
                                <fieldset>
                                <div class="row">
                                    <div class="col-lg-6 col-md-8 col-sm-12 col-md-offset-2 col-lg-offset-3">
                                        <div style="color:#9aa4af; height:600px;">
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
                                                <label class="col-md-3 control-label" for="name">Name</label>
                                                <div class="col-md-9">
                                                    <input id="name" name="name" type="text" value="{{$user->name}}" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="tel">Phone</label>
                                                <div class="col-md-9">
                                                    <input id="tel" name="tel" type="text" value="{{$user->tel}}" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="location">Location</label>
                                                <div class="col-md-9">
                                                    <input id="location" name="location" type="text" value="{{$user_information->location}}" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="sex">Gender</label>
                                                <div class="col-md-9">
                                                    <select id="sex" name="sex" class="form-control input-md" required="required">
                                                        <option value="male" selected="{{($user_information->sex=='male')?'selected':''}}">Male</option>
                                                        <option value="female" selected="{{($user_information->sex=='female')?'selected':''}}">Female</option>
                                                        <option value="unknown" selected="{{($user_information->sex=='unknown')?'selected':''}}">Unknown</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!--<div class="form-group">
                                                <label class="col-md-3 control-label" for="rank">Rank</label>
                                                <div class="col-md-9">
                                                    <input id="rank" name="rank" type="text" value="{{$user_information->rank}}" class="form-control input-md" required="">
                                                </div>
                                            </div>
                                            -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-offset-3">
                                    <div class="form-group">
                                        <button id="submit" name="submit" class="btn btn-product bambu-color1">update profile</button>
                                    </div>
                                </div>
                                </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection