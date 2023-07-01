<?php declare(strict_types=1);

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
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
