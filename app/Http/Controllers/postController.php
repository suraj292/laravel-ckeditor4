<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class postController extends Controller
{
    public function index(){
        $post = Posts::all();
        return view('posts-view', ['posts'=>$post, ]);
    }

    public function store(Request $request){
        $storeData = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
        ]);


        $post = Posts::create($storeData);
        return redirect(route('post.view'))->with('created', 'Post has been saved');
//        dd($post);
    }
    public function storeImage(Request $request)
    {
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;

            $request->file('upload')->move(public_path('images'), $fileName);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName);
            $msg = 'Image uploaded successfully';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $response;
        }
    }

    public function detroy(Posts $id)
    {
        $id->delete();
        return redirect(route('post.view'))->with('deleted', 'Post has been deleted.');
    }
}
