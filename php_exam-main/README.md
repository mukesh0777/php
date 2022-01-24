# Notre projet PHP

 

Nous avons fait une base de données en php.
Voici sa structure : 
![](https://i.imgur.com/8jHBrPB.png)
![](https://i.imgur.com/ugtDCwM.png)

Nous avons pu réaliser :

- une page login et register pour pouvoir se connecter et créer son compte.
    - le mot de passe est crypté en md5
    - double confirmation du mot de passe
    - stoquage en bdd des information utilisateurs

- Une page home qui recense tous les évènements postés les plus récent en premier.
    - on peut cliquer sur les détails de l'évènement pour voir plus en détail l'évènement

- une page profil avec une page modifier son profil( on peut y acceder par le rouage), on peut modifier le pseudo, l'adresse mail et le mdp.
    - l'importation de photo de profil n'est pas codée

- Une page Edit lié a un article qui permet d'editer un article quand on en est le propriétaire

- Une page connexion Admin et Panel Admin ou cet administrateur peut modifier ou supprimer n'importe quel article et/ou utilisateur.
    - on y accède par l'url `http://localhost/php_exam/admin.php` avec le mot de passe "TasCruQuoi!?"
    - ou alors si on a la valeur authorityLevel à 2 en bdd
    - on peut supprimer et modifier les évènements du site
    - on peut supprimer les utilisateurs

- une page de création d'articles basique

- un module db connect permetant d'économiser du code, également un module navbar

- j'ai oublié de rajouter le lien des profil mais on peut y accèder comme ça : `http://localhost/php_exam/profil.php?id=1`

Dans un cas concret , l'utilisateur arrive sur une page d'authentification avec la possibilité de se connecter ou de s'inscrire.
Une fois qu'il s'est inscrit, l'utilisateur doit se connceter a nouveau pour acceder a la page Home.
Il a la possibilité d'allez sur la page Articles, Profil, ou se logout.