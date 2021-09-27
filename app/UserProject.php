<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserProject extends Model
{

    protected $table = 'userprojects';
    //Primary Key
    public $primaryKey = 'userprojectid';
    // Timestamps
    public $timestamps=true;

    protected $fillable = [
        'id', 'projectid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'id')->withTrashed(); 
    }
    public function project()
    {
        return $this->belongsTo(Project::class,'projectid')->withTrashed(); 
    }
}
