<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable=['name','description','price','intro_url'];

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class);
    }
}
