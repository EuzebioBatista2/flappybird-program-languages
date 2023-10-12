@extends('layouts.app')

@section('content')
  <register-component :error="{{ $errors->toJson() }}" csrf-Token="{{ csrf_token() }}" :old-data="{{ json_encode(old()) }}"></register-component>
@endsection