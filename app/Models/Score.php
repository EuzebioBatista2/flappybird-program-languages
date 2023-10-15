<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    //Data required
    protected $fillable = ['userId', 'score'];

    //Relationship between User and Score(1X1)
    public function user() {
      return $this->hasOne('App\Models\User', 'id', 'userId');
    }
}
