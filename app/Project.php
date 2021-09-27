<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Project extends Model
{
    protected $table = 'projects';
    //Primary Key
    public $primaryKey ='projectid';
    // Timestamps
    public $timestamps=true;

    protected $fillable = [
        'projectname'
    ];

    public function users()
    {
        return $this->hasMany(Project::class); 
    }

}
