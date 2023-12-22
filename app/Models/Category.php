<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ["id", "created_at","updated_at"];


    public function user():HasOne{
        return $this->hasOne(User::class,"id","user_id");
    }

    public function articles():HasMany{
        return $this->hasMany(Article::class,"category_id","id");
    }

    public function articlesActive():HasMany{
        return $this->hasMany(Article::class,"category_id","id")->where("status",1);
    }
}
