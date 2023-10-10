@extends('layouts.app')

@section('content')
  <login-component :error="{{ $errors->toJson() }}" csrf-Token="{{ csrf_token() }}"></login-component>
@endsection