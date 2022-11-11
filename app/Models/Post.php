<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['title', 'description'];

    protected $date = ['deleted_at'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->morphMany(Photo::class,'imagable');
    }

    public function tags() {
        return $this->morphToMany(Tag::class,'taggable','taggable');
    }
}
