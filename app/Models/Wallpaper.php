<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallpaper extends Model
{
    use HasFactory;
    protected $connection = 'mysql';
    protected $table = 'wp-wallpapers';
    protected $fillable=[
     'title',   
     'alt',   
     'likes',   
     'url',   
     'user_id',   
    ];
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'wp-tag_wallpaper');
    }
}
