<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contribution extends Model
{
    use HasFactory;

    protected $table = 'contributions';

    protected $fillable = ['contributor_id', 'type', 'value', 'start_date', 'end_date', 'status'];
}
