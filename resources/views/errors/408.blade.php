@extends('errors.layout')

@php
  $error_number = 408;
@endphp

@section('title')
  Verzoek time-out
@endsection

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a>, refresh the page and try again.";

  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection
