<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Requirement extends Model
{
    protected $table = 'requirements';
    //Primary Key
    public $primaryKey ='reqid';
    // Timestamps
    public $timestamps=true;

    protected $fillable = [
        'projectid', 'reqtitle', 'reqreference'
    ];

    public function requirements()
    {
        return $this->belongsTo(Project::class,'projectid'); 
    }
}
