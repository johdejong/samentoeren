@component('mail::message')
# Bevestiging intrekking deelname

Met dit bericht bevestigen we je intrekking van deelname. Jammer dat je niet meegaat.<br>
Tot een volgende keer.

Naam: **{{ $ride->name }}**<br>
Datum: **{{ \Carbon\Carbon::parse($ride->start_date)->formatLocalized('%A %e %B %Y') }}**

@component('mail::button', ['url' => 'https://toeren.johanenjolanda.nl'])
bezoek Samen Toeren
@endcomponent

Met vriendelijke motorgroet,<br>
{{ config('app.name') }}
@endcomponent
