# ITS website

This is the ITS website! It contains all the news, projects, members and information of the association. Good reading!

## Description
On this website, there are :
- A welcome page containing the news, the different poles, some random projects, an agenda, a description of the association, the team, some figures, a word of the director, the collaborators and a contact section.
- A page for each pole containing the linked projects
- A page for each project giving all the information necessary for a good understanding of the project.
- A page to find all the projects
- A page to find all the members
- A helpdesk (Besoin d'aide) to help members in case of problems
- A page to login
- A page for each user
- The darkpage (an admin page containing a general section, a member section and a news section)
- A timeline and an evolution for each project
- Comments sections
- A timeline for each pole
- A suggestion box page

## Future features
On the website, it is planned that we will soon develop:
- suprises

If you have other ideas, do not hesitate to let us know ;)

## Programming languages
This project is coded with :
- `php` with the framework `Laravel`
- `css` with the framework `Bootstrap`

If you want to contribute to this project, we recommend that you master the basics of these languages. You can find tutorials on Openclassroom, and to learn Laravel, we highly recommend this one: https://laracasts.com/series/laravel-6-from-scratch.


## Project installation

If you're here, you've probably already cloned the repository. We will assume that you have already followed the Laravel tutorial and performed all the installations presented in episodes 2 and 3. In addition, a php version greater than 7.3.0 is required (`php -v` to know your version).

If so, follow the next instructions and everything should be fine (in theory)!

Start by going into the directory `site-web/website`, then enter the command:
```sh
composer install
```
(To install Composer, folow the instructions on https://getcomposer.org/download/)

To add a package to the site and on Ionos, follow : <br>
https://www.ionos.com/digitalguide/websites/web-development/using-php-composer-in-ionos-webhosting-packages/

A file `.env.example` is present in the website directory, rename it to `.env`. Then modify the information concerning the connection to the database. You must have already created a database to be able to connect to it.

The lines to modify are:
```
DB_DATABASE=name_of_the_database
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

For those who don't remember how to create a database. If you don't have a password,
```sh
sudo mysql -u root
```
Otherwise,
```sh
sudo mysql -u root -p
```
The first password is for sudo, the second is for mysql. If you don't remember your password, try `root`, we never know^^

Then, to create the database:
```sh
CREATE DATABASE name_of_the_database;
```
Note that there is a `;` at the end of the command;)
Now, you have your BDD !!! :D
To manage it, I recommend tablePlus or another software to manage databases (we will avoid using the terminal for that it's rather painful)

Or, when connected to mysql, type  ```source site_ITS_db.sql;```  to import the database downloaded online.

Let's go back to the installation:
```sh
php artisan key:generate
php artisan serve
```
The last command starts the local server. Now everything is ready :D

The development has to be done on the Dev branch of the git then merged to the master one designed for production : 
```sh
git checkout dev
```
Then when pushed on the dev branch
```sh
git checkout master
git merge dev
git push origin master
```
Then, a worklow will automatically update the website on Ionos. Your work is now visible at  `https://info-telecom-strasbourg.fr` !


## Database
### In case of connection problems to the database

Try these 3 commands:
```sh
php artisan config:cache
php artisan config:clear
php artisan cache:clear
```

In the php.ini, uncomment lines:

```
extension=curl
extension=fileinfo
extension=mbstring
extension=openssl
extension=pdo_mysql
extension=pdo_pgsql
```
### Simplification of the filling of the database
If you want to simplify the filling of the database, you can use the file `sql_web.sql` (wich contains a list of commands) in mysql. This file isn't on Github, but only given to the project members.

## General conventions

### Colors

- Header/navbar/button/breadcrump link: <span style="background-color:#274494">#274494</span>

- Line below the page title: <span style="background-color:#4472C4">#4472C4</span>

- Dark blue for the navbar: <span style="background-color:#254395">#254395</span>

- Light blue for the navbar: <span style="background-color:#5C6FA3">#5C6FA3</span>

- Gray for the lines next to the "voir-plus" button: <span style="background-color:#A4A4A4; color: black">#A4A4A4</span>

### CSS classes

- `class="line-under-title"` for lines under page titles

- `class="line-voir-plus"` for the lines next to the "voir-plus" button
- `class="btn-rounded"` for the "voir-plus" button style

### Conventions used

- Name of variables and methods (functions): Camel classes. Example: respoName (and not respo_name)

- Language: English 

- For database column names: repo_name

## Contributors
- [Clara SCHILD](https://github.com/cschild)
- [Thomas RIVES](https://github.com/ThomasRives)
- [Hugo LAULLIER](https://github.com/HugoLaullier)
- [Clément ROSSETTI](https://github.com/Zetsyog)
- [Valentin COMPS](https://github.com/VComps)
- [Lucas SCHAEFFER](https://github.com/Lucas-67)
- [Félix LUSSEAU](https://github.com/FelixLusseau)


