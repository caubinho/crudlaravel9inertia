<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory, ImageTrait;

    protected $table = 'tenants';

    protected $fillable = [ 'name', 'image'];

    // relacionamento de muitos usuarios para um Tenant
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id',
    ];

    public $incrementing = false;

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y'),
        );
    }
}
