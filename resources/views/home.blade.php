@extends('layouts.app')

@section('content')
  <home-game-component char="{{$data}}" id="{{$id}}"></home-game-component>
@endsection
