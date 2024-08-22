<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'type', 'data', 'read'];

    // Optionally, define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
