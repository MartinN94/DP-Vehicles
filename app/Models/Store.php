<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\SearchTrait;

class Store extends Model
{
    use HasFactory;
    use SearchTrait;

    protected $fillable = ['name', 'location'];
}
