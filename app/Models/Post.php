<?php

namespace App\Models;

use App\Scopes\LatestScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable=['title','description','user_id','category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function image()
    {
       return $this->morphOne(Image::class,"imageable");
    }
    public function likes()
    {
        return $this->morphMany(Like::class,'likeable');
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope(new LatestScope);
      
    }

   public function scopeMostPostCommented(Builder $builder)
    {
       $builder->withCount('comments')->orderBy('comments_count','DESC');
    }
    public function scopePostWithUserCommentsTags(Builder $builder)
    {
        $builder->withCount('comments')->with(['user', 'tags','image']);
    }

   
}
