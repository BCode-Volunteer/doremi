<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contributor extends Model
{
    use HasFactory;

    protected $table = 'contributors';
    protected $fillable = ['name', 'email', 'phone'];

    public function contributions(): HasMany
    {
        return $this->hasMany(Contribution::class);
    }
}
