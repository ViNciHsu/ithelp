<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    // 每一篇文章都會有一個作者
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    protected $fillable = ['title','content'];
}
