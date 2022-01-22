<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'wp-tags';
    protected $fillable = [
        'title',
        'slug',
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function wallpapers()
    {
        return $this->belongsToMany(Wallpaper::class, 'wp-tag_wallpaper')->orderBy('id','DESC');
    }
}
