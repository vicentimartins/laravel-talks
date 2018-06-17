<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{
    protected $guarded = [];

    protected $appends = ['likes_count', 'is_liked'];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($talk) {
            $talk->update(['slug' => str_slug($talk->title) . "-$talk->id"]);
        });
    }

    public function getThumbnailPathAttribute($thumbnail_path)
    {
        return asset($thumbnail_path);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function getIsLikedAttribute()
    {
        return (bool) $this->likes->where('user_id', auth()->id())->count();
    }
}
