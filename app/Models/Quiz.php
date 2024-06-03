<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static published()
 * @method static whereHas(string $string)
 */
class Quiz extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'published',
        'public',
    ];

    protected $casts = [
        'published' => 'boolean',
        'public'    => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function questions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Question::class);
    }

    public function tests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function scopePublic($q)
    {
        return $q->where('public', true);
    }

    public function scopePublished($q)
    {
        return $q->where('published', true);
    }
}
