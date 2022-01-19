<?php

namespace App\Http\Controllers\Wallpaper;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TagController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //   $data = new WallpaperCollection(Wallpaper::cursorPaginate($this->perPage));
        // return Response::json($data, 200);

        // return $this->sendResponse($data, 'Posts fetched.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['slug'] = str_replace(' ', '-', $data['slug']);
        $validator = Validator::make($data, [
            'title' => 'required',
            'slug' => 'required|alpha_dash|unique:wp-tags,slug',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }
        $data['user_id'] = auth()->user()->id;
        $tag = Tag::create($data);
        return $this->sendResponse(new TagResource($tag), 'Tag created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        if (is_null($tag)) {
            return $this->sendError('Wallpaper does not exist.');
        }
        return $this->sendResponse(new TagResource($tag), 'Wallpaper fetched.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $urlExist = Tag::where('slug', $request->slug)->where('id', '<>', $tag->id)->first();
        if ($urlExist) {
            $error['slug'] = 'Slug already taken';
            return $this->sendError($error);
        }
        $data = $request->all();
        $data['slug'] = str_replace(' ', '-', $data['slug']);
        $validator = Validator::make($data, [
            'title' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $tag->title = $request->title;
        $tag->slug = $request->slug;
        $tag->save();

        return $this->sendResponse(new TagResource($tag), 'Tag updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
