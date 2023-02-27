Ce code a pour objectif d'importer et afficher une liste de jeux vidéo à partir d'un fichier CSV sous le nom de "vgsales.csv" qui permet d'importer et de filtrer une liste de jeux vidéo. 


Importation du fichier CSV

Le code a une vue qui affiche tout les jeux vidéos. J'ai décidé de mettre tout en haut un formulaire de filtrage qui permet de sélectionner certains critères de recherche (comme la plateforme, l'année de sortie, le genre etc.).

Le contrôleur GameController est composé de deux partis :

La première fonction est appelée import et elle est chargée d'importer les données. Cette fonction utilise la librairie Maatwebsite Excel pour importer les données à partir du fichier CSV. Une fois que les données ont été importées, la fonction redirige l'utilisateur vers la page précédente et affiche un message de confirmation pour indiquer que l'importation a réussi.

La deuxième fonction du contrôleur est appelée index et elle est chargée de récupérer les données filtrées et de les afficher à l'utilisateur. Pour ce faire, la fonction ouvre le fichier CSV, extrait les headers et les données, et les stocke dans une collection. Ensuite, la fonction applique les filtres en utilisant la méthode where de la collection pour filtrer les données en fonction des critères sélectionnés par l'utilisateur.

J'ai préféré ne pas créer de base de données pour rester sur une structure simple et légère du code. J'utilise la méthode where pour appliquer les filtres. Cette méthode est très pratique car elle permet de filtrer les données de manière dynamique en fonction des critères sélectionnés par l'utilisateur. 

Affichage de la liste des jeux vidéo

La liste des jeux vidéo est affichée dans une vue nommée "index.blade.php".

Cette vue contient un formulaire avec une liste déroulante qui permet de choisir le ou les conditions qu'on veux. Les en-têtes de colonnes sont extraits du fichier CSV et affichés comme options de filtrage. 

Les données sont affichées dans un tableau avec une ligne par jeu vidéo. Les colonnes affichées sont "Rank", "Name", "Platform", "Year", "Genre", "Publisher", "NA_Sales", "EU_Sales", "JP_Sales", "Other_Sales" et "Global_Sales". 

Si aucun jeu n'est trouvé, un message est affiché. Pour faire une nouvelle recherche il faut remettre tout les listes à Tous et cliquez sur Filtrer. Sinon il permet de continuer le filtrage sur la catégorie qu'on a sélectionné.
