<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Test extends Model
{
    use HasSlug;

    protected $fillable = [
        'id',
        'title',
        'user_id',
        'slug',
        'subject_id',
        'test_type_id',
        'created_at',
        'updated_at'
    ];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
