<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    use HasFactory;

    protected $table = 'posts';

    protected $fillable = ['title', 'content', 'user_id', 'community_id', 'slug'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function community()
    {
        return $this->belongsTo(Community::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
