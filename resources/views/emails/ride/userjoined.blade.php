@component('mail::message')
# Bevestiging deelname

Leuk dat jij je hebt aangemeld. Dit is de bevestiging van je deelname.<br>

Hieronder vind je de belangrijkste gegevens.
Voor alle gegevens bezoek je *[samen toeren](https://samentoeren.johanenjolanda.nl)*. Daar kun je ook de route voor je navigatie downloaden.

## Gegevens
Naam: **{{ $ride->name }}**<br>
Datum: **{{ \Carbon\Carbon::parse($ride->start_date)->formatLocalized('%A %e %B %Y') }}**<br>
Vertrektijd: **{{ \Carbon\Carbon::parse($ride->start_time)->format('h:i') }}** uur<br>
Afstand: **{{ $ride->distance }}** km

## Vertrek
{{ $ride->start_location->name }}<br>
{{ $ride->start_location->address }}<br>
{{ $ride->start_location->postal_code }} {{ $ride->start_location->residence }}

Met vriendelijke motorgroet,<br>
[{{ config('app.name') }}](https://samentoeren.johanenjolanda.nl)
@endcomponent
