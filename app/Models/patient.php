<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
     public $timestamps = false;
    protected $table = 'formtbl';
    protected $primaryKey = 'formid';
    protected $fillable = array('*');
}