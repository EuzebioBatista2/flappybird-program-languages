@extends('layouts.app')

@section('content')
  <register-component csrf-Token="{{ csrf_token() }}"></register-component>
@endsection