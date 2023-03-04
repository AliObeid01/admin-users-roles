<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Certificates extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function certificatesPerUser(): belongsToMany
    {
        return $this->belongsToMany(user::class, 'users_certificate', 'certificate_id', 'user_id');
    }
}
