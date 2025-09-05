<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'industry',
        'description',
        'email'
    ];

    public $timestamps = true;

    public function vacancies(){
        return $this->hasMany(Vacancy::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
