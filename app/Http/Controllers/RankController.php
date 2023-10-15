<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class RankController extends Controller
{
  //Research the ranking of the top 10 best players.
  public function showRank() {
    $rank = Score::with(['user'])->orderBy('score', 'desc')->limit(10)->get();
    return view('rank', ['data' => $rank]);
  }

}
