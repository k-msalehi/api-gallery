<?php

namespace App\Http\Controllers\Wallpaper;

use App\Models\Tag;
use Illuminate\Http\Request;

class InfoController extends BaseController
{
    /**
     * returns site info
     */
    public function index()
    {
        $data['tags'] = Tag::all();
        return $this->sendResponse($data, 'info sent.');
    }

 
}
