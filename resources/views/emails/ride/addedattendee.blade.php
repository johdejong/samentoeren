@component('mail::message')
# Nieuwe deelnemer {{ $user->name }}

Beste beheerder,

**{{ $user->name }}** heeft zich aangemeld voor toerrit **{{ $ride->name }}**.

**Deelnemerslijst**<br>
<ol>
    @foreach ($ride->users as $user)
        <li>{{ $user->name }}</li>  
    @endforeach
</ol> 

Met vriendelijke motorgroet,<br>
{{ config('app.name') }}
@endcomponent