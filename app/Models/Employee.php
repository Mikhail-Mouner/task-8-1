<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'company_id',
    ];
    protected $hidden = [
        'password',
    ];

    protected $appends = [ 'img_url' ];

    public function getImgUrlAttribute()
    {
        return asset( "storage/" . $this->image );
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo( Company::class );
    }

}
