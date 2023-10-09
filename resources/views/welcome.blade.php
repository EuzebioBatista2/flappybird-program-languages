<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <style>
      @font-face {
        font-family: 'supply-Center';
        src: url('/fonts/supply-Center.ttf') format('truetype');
      }

      .font {
        font-family: 'supply-Center';
      }

      .background-sky {
        background-image: url('/background/sky.gif');
        background-size: cover;
      }
    </style>

    <!-- Styles -->

  </head>

  <body class="font background-sky">
    @extends('layouts.app')
    @section('content')
    <home-page-component></home-page-component>
    @endsection
  </body>

</html>