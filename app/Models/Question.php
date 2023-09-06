<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected  $fillable = [
        'id',
        'test_id',
        'image',
        'question_text',
        'created_at',
        'updated_at'
    ];

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}
