<!--
myprofile page
-->

@extends('base')

@section('content')
<div style="margin-top:58px;">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
        <div class="card card-2">
            <div class="caption">
                <form method="post" action="/api/users/{{$user->id}}" class="form-horizontal" enctype="multipart/form-data" role="form">
                    <fieldset>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="color:#9aa4af; max-height:600px; overflow-x:visible;">                                    
                                    @if($user_information->user_image=="/img/default_user_profile.jpg")
                                            <img style="width:100px;height:100px;margin-bottom:10px;" src="{{$user_information->user_image}}" class="img-circle"/>
                                        @else
                                            <img style="width:100px;height:100px;margin-bottom:10px;" src="/api/product/images/{{$user_information->user_image}}" class="img-circle"/>
                                        @endif
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-4 upload-button">
                                            <div class="upload"></div>
                                            <p class="upload-text">CHOOSE FILE</p>
                                            <input id="image" name="image" class="fileupload col-md-12" type="file">
                                            <!--<button type="button" onclick="uploadProfilePicture()" class="btn btn-xs">upload your profile picture</button>-->
                                        </div>
                                    </div>
                                    <h6>{{$user->name}}'s Profile</h6>
                                    <hr>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <input id="name" name="name" type="text" value="{{$user->name}}" placeholder="Name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <input id="tel" name="tel" type="text" value="{{$user->tel}}" class="form-control input-md" readOnly="true" style="border-width:0px;color:black;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <input id="location" name="location" type="text" value="{{$user_information->location}}" placeholder="Location" class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <select id="sex" name="sex" placeholder="Gender" class="form-control input-md" required="required">
                                                <option value="male" {{($user_information->sex=="male")?"selected=":""}}>Male</option>
                                                <option value="female" {{($user_information->sex=="female")?"selected=":""}}>Female</option>
                                                <option value="unknown" {{($user_information->sex=="unknown")?"selected=":""}}>Unknown</option>
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
                                    <div class="col-offset-3">
                                        <div class="form-group">
                                            <button id="submit" name="submit" class="btn btn-product bambu-color1">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection