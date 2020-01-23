# ToDoList-symfony
A to do list project using Symfony framework.

<b>Les Consignes</b>
<ul> 
  <li>Dans un premier temps télécharger le projet. | First of all download the project.</li>
  <li>Ensuite, ouvrir le terminal et se placer dans le dossier téléchargé. | Then, open the terminal and place yourself in the folder you just downloaded.</li>
  <li>Utiliser la commande "php bin/console doctrine:migrations:migrate" pour effectuer les migrations et initialiser la base de donnée. | Use the following command to initiate migrations to the database.</li>
  <li>Pour finir activer le serveur local à l'aide de MAMP (WAMP pour windows et LAMP pour Linux) et lancer le projet. | Finaly, run server using MAMP(WAMP or LAMP) and run the project.</li>
 </ul>
 
 <p>Si une erreur apparaît au niveau de le connexion à base de donnée, j'ai du modifier le port pour me connecter à MySQL dans le fichier .env ->
  (DATABASE_URL=mysql://root:root@127.0.0.1:<b>8889</b>/task?serverVersion=5.7) par défaut le port était <b>5432</b>.</p>
  

