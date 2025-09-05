<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Company;
use App\Models\Application;

class Vacancy extends Model
{
    protected $fillable = [
        'title',
        'company_id',
        'description',
        'salary',
        'job_type',
        'status'
    ];

    public $timestamps = true;

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function application(){
        return $this->hasMany(Application::class);
    }
}
