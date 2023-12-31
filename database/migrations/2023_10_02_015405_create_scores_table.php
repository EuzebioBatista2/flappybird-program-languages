<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('scores', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('userId');
      $table->integer('score');
      $table->foreign('userId')->references('id')->on('users');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('scores', function(Blueprint $table) {
      $table->dropForeign('scores_userId_forign');
    });
    Schema::dropIfExists('scores');
  }
};
