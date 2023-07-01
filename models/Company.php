<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    protected $table = 'companies';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
