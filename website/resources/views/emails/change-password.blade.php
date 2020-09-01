<!-- Send a mail for "Besoin d'aide" -->

@component('mail::message')

# Bienvenue à ITS !


Nous t'avons assigner le mot de passe suivant: {{ $password }}.
Nous te recommandons vivement de le changer pour ne pas l'oublier ;).

Toute l'équipe d'ITS te souhaite la bienvenue au sein de l'association, et a hâte de te revoir !

Cordialement,

Le CA 

@endcomponent