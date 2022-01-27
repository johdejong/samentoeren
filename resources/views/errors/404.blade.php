@extends('errors.layout')

@php
  $error_number = 404;
@endphp

@section('title')
  De pagina is niet gevonden
@endsection

@section('description')
  @php
    $default_error_message = "Ga alstublieft <a href='javascript:history.back()''>een stap terug</a> of keer terug <a href='".url('')."'>naar de homepage</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection