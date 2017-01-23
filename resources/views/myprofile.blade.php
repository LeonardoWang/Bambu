<!--
myprofile page
-->

@extends('base')

@section('content')
                  <div class="col-sm-12 col-md-8 col-lg-6 col-md-offset-2 col-lg-offset-3">
                        <div class="thumbnail" >
                            <div class="caption">
                                <div class="row">
                                    <div class="col-lg-8 col-md-10 col-sm-12 col-md-offset-1 col-lg-offset-2">
                                        <div style="color:#9aa4af; overflow:auto; height:600px;">
                                            <img style="width:80px;" src="/img/icons/svg/clipboard.svg"/>
                                            <h6>personal info</h6>
                                            <hr>
                                            @if(!strlen($user_information->user_image))
                                            <img style="width:100px;" src="/img/default_user_profile.jpg"/>
                                            @else
                                            <img style="width:100px;" src="{{$user_information->user_image}}"/>
                                            @endif
                                            <p> username: {{$user->name}}</p>
                                            <p> Bambu_ID: {{$user->id}}</p>
                                            <p> cell phone: {{$user->tel}}</p>
                                            <p> location: {{$user_information->location}}</p>
                                            <p> sex: {{$user_information->sex}}<p>
                                            <p> rank: {{$user_information->rank}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-offset-3">
                                        <a href="/api/users/{{$user->id}}" class="btn btn-success btn-product bambu-color1"><span class="fa fa-shopping-cart"></span> upload your information</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
@endsection