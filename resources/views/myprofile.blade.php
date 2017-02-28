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
                                <div style="color:#9aa4af; max-height:650px; overflow-x:visible;">                                    
                                    @if($user_information->user_image=="/img/default_user_profile.jpg")
                                            <img style="width:100px;height:100px;margin-bottom:10px;" src="{{$user_information->user_image}}" class="img-circle"/>
                                        @else
                                            <img style="width:100px;height:100px;margin-bottom:10px;" src="/api/product/images/{{$user_information->user_image}}" class="img-circle"/>
                                        @endif
                                    <div class="form-group">
                                        <div class="col-md-4 col-md-offset-4 upload-button">
                                            <div class="upload"></div>
                                            <p id="p_1" class="upload-text">CHOOSE FILE</p>
                                            <input id="image" name="image" class="fileupload col-md-12" type="file" onchange="preview(this,1)">
                                            <div id="preview1" style="left:0; right:0; top:0; bottom:0;margin:auto;position:absolute; z-index:-1;"></div>
                                        </div>
                                    </div>
                                    <h6 style="color:black;">{{$user->name}}'s Profile</h6>
                                    <button type="button" onclick="javascript:window.location.href='/createpassword'" class="btn btn-xs col-md-4 col-md-offset-4">Change Password</button>
                                    <br>
                                    <hr style="margin-top:0px;">
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <input id="name" name="name" type="text" value="{{$user->name}}" placeholder="Name" class="form-control input-md" required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <select id="sex" name="sex" class="form-control input-md" required="required">
                                                <option value="male" {{($user_information->sex=="male")?"selected=":""}}>Male</option>
                                                <option value="female" {{($user_information->sex=="female")?"selected=":""}}>Female</option>
                                                <option value="unknown" {{($user_information->sex=="unknown")?"selected=":""}}>Unknown</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <input id="tel" name="tel" type="text" value="{{$user->tel}}" class="form-control input-md" readOnly="true" style="border-width:0px;color:black;">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <!--<select id="city" name="city" class="form-control input-md" required="required">
                                                <option value="Beijing" {{($user_information->city=="Beijing")?"selected=":""}}>Beijing</option>
                                                <option value="Shanghai" {{($user_information->city=="Tianjin")?"selected=":""}}>Tianjin</option>
                                                <option value="HongKong" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Macao" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Taipei" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Tianjin" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Chongqing" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Shenzhen" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Guangzhou" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Shenyang" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Qingdao" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Dalian" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Changchun" {{($user_information->city=="Shanghai")?"selected=":""}}>Shanghai</option>
                                                <option value="Harbin" {{($user_information->city=="Harbin")?"selected=":""}}>Shanghai</option>
                                                <option value="Chengdu" {{($user_information->city=="Shanghai")?"selected=":""}}>Chengdu</option>
                                                <option value="Changsha" {{($user_information->city=="Shanghai")?"selected=":""}}>Changsha</option>
                                            </select>-->
                                            <input id="city" name="city" type="text" value="{{$user_information->city}}" placeholder="City" class="form-control input-md">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 col-md-offset-2">
                                            <input id="address" name="address" type="text" value="{{$user_information->address}}" placeholder="Address" class="form-control input-md">
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