<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use HasFactory;

    protected $guarded = ["id","created_at","updated_at"];

    public function category():HasOne{
        return $this->hasOne(Category::class,"id","category_id");
    }

    public function user(): HasOne{
        return $this->hasOne(User::class,"id","user_id");
    }
}
