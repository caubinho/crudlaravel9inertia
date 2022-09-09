<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profiles';

    protected $fillable = ['name', 'description'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id',
    ];


    //valor es inicialmente un booleano (true) pero lo colocaremos a false ya que la pk no estará aumentando en 1 por cada registro nuevo
    public $incrementing = false;

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::make($value)->format('d/m/Y'),
        );
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * Permission not linked with this profile
     */
    public function permissionsAvailable()
    {


        return Permission::whereNotIn('permissions.id', function(Builder $query){

            $query->select('permission_profile.permission_id');
            $query->from('permission_profile');
            $query->where("permission_profile.profile_id", $this->id);
            })
            ->paginate();

    }
}
