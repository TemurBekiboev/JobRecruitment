<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Vacancy;

class Application extends Model
{
    protected $fillable = [
        'vacancy_id',
        'user_id',
        'cover_letter',
        'cv_file'
    ];

    public $timestamps = true;

    public function vacancy(){
        return $this->belongsTo(Vacancy::class);
    }

    public function candidate(){
        return $this->belongsTo(User::class);
    }
}
