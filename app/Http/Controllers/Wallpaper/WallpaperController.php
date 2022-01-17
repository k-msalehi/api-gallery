<?php

namespace App\Http\Controllers\Wallpaper;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Wallpaper as ResourcesWallpaper;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class WallpaperController extends BaseController
{
    public function index()
    {
        $blogs = Wallpaper::all();
        return $this->sendResponse(ResourcesWallpaper::collection($blogs), 'Posts fetched.');
    }

    
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);
        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }
        $blog = Wallpaper::create($input);
        return $this->sendResponse(new BlogResource($blog), 'Post created.');
    }

   
    public function show($id)
    {
        $blog = Wallpaper::find($id);
        if (is_null($blog)) {
            return $this->sendError('Post does not exist.');
        }
        return $this->sendResponse(new BlogResource($blog), 'Post fetched.');
    }
    

    public function update(Request $request, Wallpaper $blog)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());       
        }

        $blog->title = $input['title'];
        $blog->description = $input['description'];
        $blog->save();
        
        return $this->sendResponse(new BlogResource($blog), 'Post updated.');
    }
   
    public function destroy(Wallpaper $blog)
    {
        $blog->delete();
        return $this->sendResponse([], 'Post deleted.');
    }
}
