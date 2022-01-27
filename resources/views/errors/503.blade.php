@extends('errors.layout')

@php
  $error_number = 503;
@endphp

@section('title')
  Jij bent het niet, ik ben het
@endsection

@section('description')
  @php
    $default_error_message = "The server is overloaded or down for maintenance. Please try again later.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
