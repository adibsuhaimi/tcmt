<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Testresult extends Model
{
    protected $table = 'testresults';
    //Primary Key
    public $primaryKey ='testresultid';
    // Timestamps
    public $timestamps=true;

    protected $fillable = [
        'testresultreference', 'testcaseid', 'testresultstatus', 'testresultcomment', 'ttestresultfile','testresultduration', 'testresultvisible'
    ];
}
