@extends('base')

@section('content')


    <div class="col-lg-6 col-md-8 col-xs-12 col-lg-offset-3 col-md-offset-2 panel panel-info">
        <div class="panel-title"><h3>upload a item</h3></div>
        <div class="panel-body" >
            <form method="POST" action="product/addProduct" class="form-horizontal" enctype="multipart/form-data" role="form">
                {!! csrf_field() !!}
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="name">name</label>
                        <div class="col-md-9">
                            <input id="name" name="title" type="text" placeholder="product name" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="textarea">description</label>
                        <div class="col-md-9">
                            <textarea class="form-control" id="textarea" name="description" placeholder="describe more about your item"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="price">price</label>
                        <div class="col-md-9">
                            <input id="price" name="price" type="text" placeholder="your price" class="form-control input-md" required="">

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="file">one picture for item</label>
                        <div class="col-md-9">
                            <input id="file" name="image" class="input-file" type="file">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="submit"></label>
                        <div class="col-md-9">
                            <button id="submit" name="submit" class="btn btn-primary bambu-color1">upload and sell!</button>
                        </div>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>
@endsection