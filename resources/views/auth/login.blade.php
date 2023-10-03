@extends('layouts.app')

@section('content')
  <login-component :error="{{ $errors->toJson() }}" csrf-Token="{{ csrf_token() }}"></login-component>
@endsection

{{-- @section('styles')
  <style>
    .background-gif {
      background-image: url('/background/sky-clouds.gif');
      background-size: cover;
      height: 100vh;
      widows: 100vw;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
@endsection --}}