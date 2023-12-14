<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'status_id',
        'category_id',
        'subject',
        'description',
        'url_image'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('accessibleByUser', function (Builder $builder) {
            $user = auth()->user();

            if ($user->hasRole('admin')) {
                // Admin tem acesso a todos os tickets
                return;
            }

            // Usuário regular só tem acesso aos seus próprios tickets
            $builder->where('user_id', $user->id);
        });
    }
}
