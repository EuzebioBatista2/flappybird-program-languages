<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{

  public function showByUserId($userId) 
  {
    $score = Score::with(['user'])->where('userId', $userId)->first();


    if(isset($score)) {
      return $score;
    } else {
      return null;
    }
  }

  public function deleteByUserId($userId) 
  {
    Score::where('userId', $userId)->first()->delete();
  }

  public function store(Request $request)
  {
    //
    Score::create($request->all());
  }
}
