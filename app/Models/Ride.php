<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Ride extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    // use HasFactory, SoftDeletes;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type_id',
        'status_id',
        'start_location_id',
        'finish_location_id',
        'start_date',
        'start_time',
        'finish_date',
        'finish_time',
        'distance',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'type_id' => 'integer',
        'status_id' => 'integer',
        'start_location_id' => 'integer',
        'finish_location_id' => 'integer',
        'start_date' => 'date',
        'finish_date' => 'date',
        'distance' => 'integer',
    ];

    public function users()
    {
        return $this->belongsToMany(\App\Models\User::class);
    }

    public function routes()
    {
        return $this->belongsToMany(\App\Models\Route::class);
    }

    public function type()
    {
        return $this->belongsTo(\App\Models\Type::class);
    }

    public function status()
    {
        return $this->belongsTo(\App\Models\Status::class);
    }

    public function start_location()
    {
        return $this->belongsTo(\App\Models\Location::class, "start_location_id");
    }
    
    public function finish_location()
    {
        return $this->belongsTo(\App\Models\Location::class, "finish_location_id");
    }
}
