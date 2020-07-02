@component('mail::message')

# Besoin d'aide


### Type de demande : {{ $type }}
### Appareil : {{ $appareil }} 
### Système d'exploitation : {{ $os }}
### Messages :
{{ $desc }}

@endcomponent