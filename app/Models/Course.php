<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes,HasFactory;
    protected $fillable=['name','description','price','intro_url','thumbnail_url'];

    public function subscriptions(): HasMany
    {
        return $this->hasMany(Course::class);
    }
    public function videos(): BelongsToMany
    {
        return $this->belongsToMany(Video::class);
    }

    public function materials(): BelongsToMany
    {
        return $this->belongsToMany(Material::class);
    }
}
