<!-- Send a mail for "Inscription" -->

@component('mail::message')

# Bienvenue à ITS !

Avec un peu de retard, nous avons créé ton compte sur le site de l'association !! <br>
Celui-ci te permet de nous envoyer des messages si tu as besoin d'aide, de t'inscrire à des cours ou formations, 
de montrer ta participation à des projets visibles sur le site et de poster des commentaires. <br><br>

Nous t'avons assigné le mot de passe temporaire suivant : {{ $password }}.<br>
Nous te recommandons vivement de le changer par sécurité et pour ne pas l'oublier ;).<br>


@component('mail::button', ['url' => 'https://info-telecom-strasbourg.fr/users/' . $id])
Changer mon mot de passe
@endcomponent


Toute l'équipe d'ITS te souhaite la bienvenue au sein de l'association, et a hâte de te revoir !<br>
<br>
Cordialement,<br>
Le CA 
@endcomponent