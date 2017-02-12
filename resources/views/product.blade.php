<!--
item uploading page
-->

@extends('basenofooter')

@section('content')

    <div class="col-lg-6 col-md-6 col-sm-8 col-lg-offset-3 col-md-offset-3 col-sm-offset-2 panel">
        <div class="panel-title"><h3>Upload an item</h3></div>
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
        <div class="panel-body" >
            <form method="POST" action="product/addProduct" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="name">Name</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="name" name="title" type="text" placeholder="name your item!" class="form-control input-md" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="textarea">Description</label>
                        <div class="col-sm-8 col-md-8">
                            <textarea id="description" name="description" placeholder="describe more about your item" class="form-control" required="required"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="price">Price</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="price" name="price" type="text" placeholder="￥your price" class="form-control input-md" required="required">

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
                        <label class="col-sm-3 col-md-3 control-label" for="file">One picture for item</label>
                        <div class="col-sm-8 col-md-8">
                            <input id="file" name="image" class="form-control input-md" type="file"> <!--multiple="true"-->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 col-md-3 control-label" for="category">Category</label>
                        <div class="col-sm-8 col-md-8">
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
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-6">
                            <button id="submit" name="submit" class="btn btn-primary bambu-color1">upload and sell!</button>
                        </div>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>
@endsection