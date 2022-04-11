<!-- Send a mail for "Besoin d'aide" -->

@component('mail::message')

# Bienvenue à ITS !


Nous t'avons assigné le mot de passe suivant: {{ $password }}.<br>
Nous te recommandons vivement de le changer pour ne pas l'oublier ;).<br>


@component('mail::button', ['url' => 'https://info-telecom-strasbourg.fr/users/' . $id])
Changer mon mot de passe
@endcomponent


Toute l'équipe d'ITS te souhaite la bienvenue au sein de l'association, et a hâte de te revoir !<br>
<br>
Cordialement,<br>
Le CA 
@endcomponent