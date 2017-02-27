<!--
item uploading page
-->

@extends('basenofooter')

@section('content')

    <div class="col-lg-4 col-md-4 col-sm-6 col-lg-offset-4 col-md-offset-4 col-sm-offset-3 card card-2">
        <div><h3 style="font-family:NexaBold;color:black">Upload item</h3></div>
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Error:</strong><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <div>
            <form method="POST" action="product/addProduct" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2" style="padding-left:0px;padding-right:0px;">
                            <input id="name" name="title" type="text" placeholder="ITEM NAME" class="form-control input-md" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2" style="padding-left:0px;padding-right:0px;">
                            <textarea id="description" name="description" placeholder="ITEM DESCRIPTION" class="form-control" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2" style="padding-left:0px;padding-right:0px;">
                            <input id="price" name="price" type="text" placeholder="PRICE" class="form-control input-md" required="required">
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
                    <div class="form-group">
                        <div class="col-md-2 col-md-offset-2 upload-button" id="preview1">
                            <span>
                                <div class="upload"></div>
                                <p class="upload-text">CHOOSE FILE</p>
                                <input id="file_upload_1" name="image_1" class="fileupload col-md-12" type="file" >
                            </span>
                        </div>
                        <div class="col-md-2 upload-button" id="preview2">
                            <span>
                                <div class="upload"></div>
                                <p class="upload-text">CHOOSE FILE</p>
                                <input id="file_upload_2" name="image_2" class="fileupload col-md-12" type="file" onchange="preview(this,2)">
                            </span>
                        </div>
                        <div class="col-md-2 upload-button" id="preview3">
                            <span>
                                <div class="upload"></div>
                                <p class="upload-text">CHOOSE FILE</p>
                                <input id="file_upload_3" name="image_3" class="fileupload col-md-12" type="file" onchange="preview(this,3)">
                            </span>
                        </div>
                        <div class="col-md-2 upload-button" id="preview4">
                            <span>
                                <div class="upload"></div>
                                <p class="upload-text">CHOOSE FILE</p>
                                <input id="file_upload_4" name="image_4" class="fileupload col-md-12" type="file" onchange="preview(this,4)"z>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-2" style="padding-left:0px;padding-right:0px;">
                            <select id="category" name="category" class="form-control input-md" required="required">
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
                        <button id="submit" name="submit" class="col-md-8 col-md-offset-2 btn bambu-color1">CONFIRM</button>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>
@endsection