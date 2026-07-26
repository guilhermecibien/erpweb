<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class DocumentAndNote extends Model
{
    use LogsActivity;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logUnguarded()->logOnlyDirty();
    }


    /**
    * Get all of the owning notable models.
    */
    public function notable()
    {
        return $this->morphTo();
    }
    
    public function media()
    {
        return $this->morphMany(\App\Models\Media::class, 'model');
    }

    /**
     * Get the user who added note.
     */
    public function createdBy()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }
}
