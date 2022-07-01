<?php declare(strict_types=1);

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
