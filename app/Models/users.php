<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $timestamps = false;
    protected $table = 'usertbl';
    protected $primaryKey = 'userid';
    protected $fillable = array('*');
}
