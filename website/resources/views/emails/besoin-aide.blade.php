@component('mail::message')

# Demande de contact


### De : {{ $type }}
### Object : {{ $appareil }} {{ $os }}

<br>

{{ $desc }}

@endcomponent