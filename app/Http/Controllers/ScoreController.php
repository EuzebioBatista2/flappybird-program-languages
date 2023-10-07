<?php

namespace App\Http\Controllers;

use App\Models\Score;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  public function showByUserId($userId) 
  {
    $score = Score::with(['user'])->where('userId', $userId)->first();


    if(isset($score)) {
      return response()->json($score);

    }

    return response()->json(['error' => 'dados não encontrado'], 404);
  }

  public function deleteByUserId($userId) 
  {
    Score::where('userId', $userId)->first()->delete();
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
    Score::create($request->all());
  }

  /**
   * Display the specified resource.
   */
  public function show(Score $score)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Score $score)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Score $score)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Score $score)
  {
    //
  }
}
