<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{

    protected $fillable = ['name', 'address'];
    public function classrooms(): \Illuminate\Database\Eloquent\Relations\HasMany|School
    {
        return $this->hasMany(Classroom::class);
    }
}
