<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name'];
    public function courses(): \Illuminate\Database\Eloquent\Relations\HasMany|Subject
    {
        return $this->hasMany(Course::class);
    }
}
