<?php

namespace App\Models;

use App\Models\Traits\ImageTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory, ImageTrait;

    protected $table = 'plans';

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'stripe_id'
    ];

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

    public function getPriceBrAttribute()
    {
        return number_format($this->price, 2, ',', '.');
    }

    // muitos pra um, um plano pode ter varios detalhes
    public function details()
    {
        return $this->hasMany(DetailPlan::class);
    }
}
