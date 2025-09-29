<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class lead extends Model
{
     use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'company_name',
        'job_title',
        'website',
        'industry',
        'score',
        'category',
        'website_analysis'
    ];
}
