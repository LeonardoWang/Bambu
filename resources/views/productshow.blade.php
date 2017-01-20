<!--
trade confirmation page
-->

@extends('base')

@section('content')
    @if (!isset($product) > 0)
        @foreach ($products as $product)
            <div class="col-lg-4 col-md-4 col-sm-6">
                <div><h5>item info</h5></div>
                <div>
                    <div class="thumbnail" >
                        <!--<img src="images/{{$product->image_file}}" class="img-responsive">-->
                        <img src="/public/img/1.jpg" class="img-responsive">
                            
                        <div class="caption">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>name:{{$product->title}}</p>
                                    <p>price:￥{{$product->price}}</p>
                                    <p>seller:
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-4 col-sm-offset-1" style="margin-top:10%">
                        <form method="POST" action="#" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-sm-4 col-md-3 control-label" for="name">Item price</label>
                        <div class="col-sm-8 col-md-9">
                            <p>￥{{$product->price}}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">Your offer</label>
                        <div class="col-md-9">
                            <input id="price" name="price" type="text" placeholder="￥" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">And/Or add item for trade</label>
                        <div class="col-md-9">
                            <input id="file" name="image" class="input-file" type="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">Leave a message</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description" placeholder="any more specific comments?"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary bambu-color1">trade</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
        @endforeach
    @endif
@endsection
