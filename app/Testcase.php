<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Testcase extends Model
{
    protected $table = 'testcases';
    //Primary Key
    public $primaryKey ='testcaseid';
    // Timestamps
    public $timestamps=true;

    protected $fillable = [
        'reqid', 'id', 'testcasereference', 'testcasetitle', 'testcaseprecondition', 'testcasestep', 'testcaseexpresult', 'testcasefile', 'testcasepriority', 'testcaseassign', 'testcaseexptime'
    ];
}
