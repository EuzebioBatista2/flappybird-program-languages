<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
  //Show player score
  public function showByUserId($userId) 
  {
    $score = Score::with(['user'])->where('userId', $userId)->first();


    if(isset($score)) {
      return $score;
    } else {
      return null;
    }
  }

  //Update play score
  public function updateByUserId(Request $request, $userId)
  {
    $score = Score::where('userId', $userId)->first();

    if ($score) {
        $score->update($request->all());
    }
  }


  //Create player score
  public function store(Request $request)
  {
    //
    Score::create($request->all());
  }
}
