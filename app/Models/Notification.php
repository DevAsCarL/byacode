<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'user_id'
    ];

    public function user(): BelongsToMany
    {
       return $this->belongsToMany(User::class, 'user_id');
    }

}
