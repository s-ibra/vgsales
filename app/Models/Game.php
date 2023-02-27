<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $fillable = [
        'Rank',
        'Name',
        'Platform',
        'Year',
        'Genre',
        'Publisher',
        'NA_Sales',
        'EU_Sales',
        'JP_Sales',
        'Other_Sales',
        'Global_Sales',
    ];
}