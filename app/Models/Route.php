<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Route extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description', 
        'image', 
        'size', 
        'path',
        'mimetype', 
        'distancecategory_id',
        'start_residence_id',
        'finish_residence_id',
        'distance',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
    ];

    public function rides()
    {
        return $this->belongsToMany(\App\Models\Ride::class);
    }

    public function distancecategory()
    {
        return $this->belongsTo(\App\Models\Distancecategory::class);
    }

    public function start_residence()
    {
        return $this->belongsTo(\App\Models\Residence::class, "start_residence_id");
    }
    
    public function finish_residence()
    {
        return $this->belongsTo(\App\Models\Residence::class, "finish_residence_id");
    }

    public function setImageAttribute($value)
    {
        $curYear = date('Y'); 
        $curMonth = date('m');
        $attribute_name = "image";
        $disk = "gpx";
        $destination_path = $curMonth . '/' . $curYear;

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public static function boot()
    {
        parent::boot();
        static::deleting(function($obj) {
            \Storage::disk('gpx')->delete($obj->image);
        });
    }

    public function uploadFileToDisk($value, $attribute_name, $disk, $destination_path)
    {
        // if a new file is uploaded, delete the file from the disk
        if (request()->hasFile($attribute_name) &&
            $this->{$attribute_name} &&
            $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if the file input is empty, delete the file from the disk
        if (is_null($value) && $this->{$attribute_name} != null) {
            \Storage::disk($disk)->delete($this->{$attribute_name});
            $this->attributes[$attribute_name] = null;
        }

        // if a new file is uploaded, store it on disk and its filename in the database
        if (request()->hasFile($attribute_name) && request()->file($attribute_name)->isValid()) {
            // 1. Generate a new file name
            $file = request()->file($attribute_name);
            // $new_file_name = md5($file->getClientOriginalName().random_int(1, 9999).time()).'.'.$file->getClientOriginalExtension();
            $new_file_name = time().' - '.$file->getClientOriginalName();

            // 2. Move the new file to the correct path
            $file_path = $file->storeAs($destination_path, $new_file_name, $disk);

            // 3. Save the complete path to the database
            $this->attributes[$attribute_name] = $file_path;
        }
    }
}