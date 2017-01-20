<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Storage;
use Crypt;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Image;

class ImagesController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'item_id' => 'required',
            'image_file' => 'required|image'
        ]);
        $item_id = $request->input('item_id');
        if ($request->hasFile('image_file')) {
            $file_name = strval($item_id) . strval(time()) . strval(mt_rand(1,100)) . '.jpg';
            Storage::put('images/' . $file_name,
                file_get_contents($request->file('image_file')->getRealPath()));
            $image_record = New Image;
            $image_record->item_id = $item_id;
            $image_record->filename = $file_name;
            if ($image_record->save()) {
                return $file_name;
            } else {
                return 0;
            }
        }
        else {
            return 0;
        }
    }

    public function show($image_file)
    {
        $file = Storage::get('images/' . $image_file);
        return (new Response($file, 200))->header('Content-Type', 'image/jpeg');
    }

    public function destroy($image_file)
    {
        Storage::delete('images/' . $image_file);
        $image_record = Image::where('filename', $image_file)->first();
        $image_record->delete();
        return 1;
    }
}
