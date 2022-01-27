@component('mail::message')
# Bevestiging deelname

Leuk dat jij je hebt aangemeld. Dit is de bevestiging van je deelname.<br>

Hieronder vind je de belangrijkste gegevens.
Voor alle gegevens, inclusief de te downloaden route voor je navigatie, bezoek je Samen Toeren.

## De toertocht in het kort
Naam: **{{ $ride->name }}**<br>
Datum: **{{ \Carbon\Carbon::parse($ride->start_date)->formatLocalized('%A %e %B %Y') }}**<br>
Vertrektijd: **{{ \Carbon\Carbon::parse($ride->start_time)->format('h:i') }}** uur<br>
Afstand: **{{ $ride->distance }}** km

## Plaats van vertrek
{{ $ride->start_location->name }}<br>
{{ $ride->start_location->address }}<br>
{{ $ride->start_location->postal_code }} {{ $ride->start_location->residence }}

@component('mail::button', ['url' => 'https://toeren.johanenjolanda.nl'])
bezoek Samen Toeren
@endcomponent

Met vriendelijke motorgroet,<br>
{{ config('app.name') }}
@endcomponent
