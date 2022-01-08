<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'logo',
    ];
    protected $appends = ['img_url'];

    public function getImgUrlAttribute()
    {
        return asset("storage/".$this->logo);
    }
    public function employees(): HasMany
    {
        return $this->hasMany( Employee::class );
    }

}
