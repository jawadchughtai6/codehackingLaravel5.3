<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class AdminMediasController extends Controller
{
    //
    public function index(){

        $photos = Photo::all();
        return view('admin.media.index', compact('photos'));
    }

    public function create(){
        return view('admin.media.create');
    }

    public function store(Request $request){

        $file = $request->file('file'); //dropzone gets this

        $name = time() . $file->getClientOriginalName();
        $file->move('images', $name);

        Photo::create(['file'=>$name]);
    }

    public function destroy($id){
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->file);
        $photo->delete();
//
//        return redirect('/admin/media');
    }

    public function deleteMedia(Request $request){

        //return dd($request);

//        if(isset($request->delete_single)){
////            return "It Works";
//            $this->destroy($request->photo);
//
//            return redirect()->back();
//        }


//
//        if(isset($request->delete_all) && !empty($request->checkBoxArray)){
//            $photos = Photo::findOrFail($request);
//
//            foreach($photos as $photo){
//                $photo->delete();
//            }
//
//            return redirect()->back();
//        } else {
//            return redirect()->back();
//        }


//
//
        $photos = Photo::findOrFail($request);

        foreach($photos as $photo){
            $photo->delete();
        }

        return redirect()->back();

        //return "It Works";
    }
}
