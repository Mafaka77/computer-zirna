<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['title', 'description','path','mime'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }
}
