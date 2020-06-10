# Conventions et utilitées générales

## Les couleurs

Header/navbar/bouton/lien breadcrump: <span style="background-color:#274494">#274494</span>

Trait en dessous du titre de la page: <span style="background-color:#4472C4">#4472C4</span>

Bleu foncé de navbar: <span style="background-color:#254395">#254395</span>

Bleu clair de navbar: <span style="background-color:#5C6FA3">#5C6FA3</span>

Le gris des barres à côté du bouton "voir-plus": <span style="background-color:#A4A4A4; color: black">#A4A4A4</span>

## Les classes dans le CSS

`class="line-under-title"` pour les lignes sous les titres de pages

`class="line-voir-plus"` pour les lignes à côté du bouton "voir-plus"
`class="btn-rounded"` pour les bouton du style "voir-plus"

## Conventions utilisées

Nom des variables et des méthodes (fonctions): Camel classes

Exemple: respoName (et non pas respo_name)

Langue: Anglais (ou du moins on essaye)

Pour les noms de colonnes des bdd: repo_name

## Pour installer le projet

Si vous êtes ici, vous avez surement déjà clonné le repo. Nous suposerons que vous avez déjà suivit le tutoriel Laravel et procédé à toute les installations présentées dansles épisodes 2 et 3. De plus, une version de php supérieur à 7.3.0 est requise (`php -v` pour connaître votre version).

Une fois que toutes ces condition sont remplies, suivez les instructions et tout devrait bien se passer (en théorie)

Commencer par vous places dans le répertoire `site-web/website`, puis entrez les commandes:
```sh
composer install
```

Un fichier `.env.example` est présent dans le repertoire website, renommez le en `.env`.
Modifiez ensuite les information concernant la connection à la base de donnée.
Il faut avoir déjà créé un BDD pour pouvoir s'y connecter.

Les lignes à modifier sont:
```
DB_DATABASE=nom_de_la_database
DB_USERNAME=votre_nom_d_utilisateur_mysql
DB_PASSWORD=votre_mdp_mysql
```

Pour ceux qui ne se souvienne pas comment créer une BDD:
```sh
sudo mysql -u root
```
Si vous n'avez pas de mot-de-passe, et sinon
```sh
sudo mysql -u root -p
```
Le premier mot-de-passe est pour sudo, le second est celui de mysql. Si vous ne vous souvenez pas de votre mdp, essayez `root`, on sait jamais ^^

Puis pour créer la BDD:
```sh
CREATE DATABASE nom_de_la_database;
```
Notez qu'il y a un `;` à la fin de la commande ;)
Vous avez votre BDD !!! :D
Pour la gérer, je vous conseil tablePlus ou un autre logiciel permettant de gérer les BDD (on va éviter d'utiliser le terminal pour ça c'est plutôt pénible)

Retournons à l'installation:
```sh
php artisan key:generate
php artisan serve
```
La dernière commande permet de lancer le serveur local. À présent, vous pouvez y aller :D

## En cas de problèmes de connections à la BDD

Essayez ces 3 commandes:
```sh
php artisan config:cache
php artisan config:clear
php artisan cache:clear
```

## Quelques rappels Git

Essayez de créer une branch par fonctionnalitée:
```sh
git checkout -b nom_de_la_branche
```
Mettez des messages clairs pour les commits et n'oubliez pas: 1 commit=un changement, un ajout.

## Les conseils du chef
