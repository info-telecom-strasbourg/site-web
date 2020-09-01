<!-- Send a mail for "Contact" -->

@component('mail::message')

# Demande de contact


### De : {{ $name }}
### Object : {{ $subject }}
### Email : {{ $email }}

<br>

{{ $messages }}

@endcomponent