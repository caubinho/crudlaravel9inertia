<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use App\Tenant\Traits\TenantTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, TenantTrait, ImageTrait;

    protected $fillable = ['title', 'body', 'user_id', 'image'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id',
    ];

    public $incrementing = false;

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y'),
        );
    }

    // muitos pra um, um usuario pode ter varios posts
    public function user()
    {
        // um usuario pode ter varios post
        return $this->belongsTo(User::class);
    }

}
