<?php

namespace App\Models;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Model;

#[ApiResource]
class School extends Model
{

    protected $fillable = ['name', 'address'];
    public function classrooms(): \Illuminate\Database\Eloquent\Relations\HasMany|School
    {
        return $this->hasMany(Classroom::class);
    }
}
