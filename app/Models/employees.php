<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class employees extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $table = 'employees';
    protected $primaryKey = 'id';

    protected $fillable = [
        'idUser',
        'position',
        'salary',
        'employment_type',
        'type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}