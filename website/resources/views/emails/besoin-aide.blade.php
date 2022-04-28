<!-- Send a mail for "Besoin d'aide" -->

@component('mail::message')

# Besoin d'aide


### Type de demande : {{ $type }}
### Appareil : {{ $appareil }} 
### Système d'exploitation : {{ $os }}
### Message :
{{ $desc }}

@endcomponent