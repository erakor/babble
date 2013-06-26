
Bonjour, une petite crême-glace ?


A l'ajout d'un nouveau network, il faut mettre à jour la base de données 'babbleadmin' ET la $safe_networks array dans index.php ET créer la base de donnée du network.
/!\ le nom du network qui apparaîtra dans l'URL est le même que celui entré dans la base de données dans le champ "dbUnif". Lowercase et underscore s'il y a plusieurs mots.


/!\ les versions locale et sur DreamHost diffèrent légèrement :
- il faut changer tous les paths des fichiers css et js dans header.php. 
- il faut changer les liens qui redirigent vers d'autres pages. 
Faire un 'search all' avec un 'replace all', remplacer les adresses locales avec 'www.babble.be'.
- Il faut changer tous les setcookie().
- les index de la matrice params[] dans index.php ne sont pas le mêmes, il faut soustraire 1 aux index de la version MAMP.

oui �a marche tr�s bien