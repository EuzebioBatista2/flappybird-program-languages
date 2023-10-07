<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    use HasFactory;
    protected $fillable = ['userId', 'score'];

    public function user() {
      return $this->hasOne('App\Models\User', 'id', 'userId');
    }
}
