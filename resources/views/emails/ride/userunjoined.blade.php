@component('mail::message')
# Bevestiging intrekking deelname

Met dit bericht bevestigen we je intrekking van deelname. Jammer dat je niet meegaat.<br>
Tot een volgende keer.

Naam: **{{ $ride->name }}**<br>
Datum: **{{ \Carbon\Carbon::parse($ride->start_date)->formatLocalized('%A %e %B %Y') }}**

Met vriendelijke motorgroet,<br>
[{{ config('app.name') }}](https://samentoeren.johanenjolanda.nl)
@endcomponent
