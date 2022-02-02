<?php

namespace App\Http\Controllers\Wallpaper;

use App\Http\Resources\WallpaperCollection;
use App\Http\Resources\WallpaperResource;
use App\Models\Tag;
use App\Models\Wallpaper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;


class WallpaperController extends BaseController
{
    public function index()
    {
        $data = new WallpaperCollection(Wallpaper::orderBy('id','DESC')->paginate($this->perPage));
        // return Response::json($data, 200);

        return $this->sendResponse($data, 'Wallpaper fetched.');
    }
    public function showByTag(Tag $tag)
    {
        $wallpapers = $tag->wallpapers();
        $data = new WallpaperCollection($wallpapers->paginate($this->perPage));
        // return Response::json($data, 200);

        return $this->sendResponse($data, 'Wallpaper fetched.');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        // $data['url'] = str_replace(
        //     ['%3A', '%2F', '%3F', '%3D','%20'],
        //     [':', '/', '?', '=',' '],
        //     rawurlencode($data['url'])
        // );
        $validator = Validator::make($data, [
            'title' => 'required',
            'url' => 'required|url|unique:wp-wallpapers,url',
            'likes' => 'nullable|numeric',
            'alt' => 'nullable',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|exists:App\Models\Tag,id',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $data['user_id'] = auth()->user()->id;
        $wallpaper = Wallpaper::create($data);
        if (isset($data['tags']))
            $wallpaper->tags()->attach($data['tags']);
        return $this->sendResponse(new WallpaperResource($wallpaper), 'Wallpaper created.');
    }


    public function show(Wallpaper $wallpaper)
    {
        // $wallpaper = Wallpaper::find($id);
        if (is_null($wallpaper)) {
            return $this->sendError('Wallpaper does not exist.');
        }
        return $this->sendResponse(new WallpaperResource($wallpaper), 'Wallpaper fetched.');
    }


    public function update(Request $request, Wallpaper $wallpaper)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'title' => 'required',
            'likes' => 'nullable|numeric',
            'alt' => 'nullable',
            'url' => 'required|url',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|exists:App\Models\Tag,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $urlExist = Wallpaper::where('url', $request->url)->where('id', '<>', $wallpaper->id)->first();
        if ($urlExist) {
            $error['url'] = 'URL already taken';
            return $this->sendError($error);
        }
        $data['url'] = str_replace(
            ['%3A', '%2F', '%3F', '%3D'],
            [':', '/', '?', '='],
            rawurlencode($data['url'])
        );
        $wallpaper->title = $request->title;
        $wallpaper->likes = $request->get('likes', $wallpaper->likes);
        $wallpaper->alt = $request->get('alt', $wallpaper->alt);
        $wallpaper->save();
        if (isset($data['tags']))
            $wallpaper->tags()->sync($data['tags']);

        return $this->sendResponse(new WallpaperResource($wallpaper), 'Wallpaper updated.');
    }

    public function destroy(Wallpaper $wallpaper)
    {
        $wallpaper->tags()->detach();
        $wallpaper->delete();
        return $this->sendResponse([], 'Wallpaper deleted.');
    }
}
