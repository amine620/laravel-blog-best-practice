<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['content', 'post_id', 'user_id'];

    public function commentable()
    {
        return $this->morphTo();
    }
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,);
    }
}
