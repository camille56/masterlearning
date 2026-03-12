<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]

class Subject extends Model
{
    protected $fillable = ['name'];
    public function courses(): \Illuminate\Database\Eloquent\Relations\HasMany|Subject
    {
        return $this->hasMany(Course::class);
    }
}
