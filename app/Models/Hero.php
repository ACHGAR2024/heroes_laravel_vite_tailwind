<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'gender', 'race', 'description', 'skill_id', 'universe_id', 'photo'];

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function universe()
    {
        return $this->belongsTo(Universe::class);
    }
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}