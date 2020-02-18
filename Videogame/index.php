<?php

// Inclusion du fichier s'occupant de la connexion à la DB (TODO)
require __DIR__.'/inc/db.php'; // Pour __DIR__ => http://php.net/manual/fr/language.constants.predefined.php
// Rappel : la variable $pdo est disponible dans ce fichier

//          car elle a été créée par le fichier inclus ci-dessus

// Initialisation de variables (évite les "NOTICE - variable inexistante")
$videogameList = array();
$platformList = array();
$name = '';
$editor = '';
$release_date = '';
$platform = '';

// Si le formulaire a été soumis
if (!empty($_POST)) {
    // Récupération des valeurs du formulaire dans des variables
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $editor = isset($_POST['editor']) ? $_POST['editor'] : '';
    $release_date = isset($_POST['release_date']) ? $_POST['release_date'] : '';
    $platform = isset($_POST['platform']) ? intval($_POST['platform']) : 0;
    
    // TODO #3 (optionnel) valider les données reçues (ex: donnée non vide)
    // --- START OF YOUR CODE ---
    if(empty($name) === true) {
        die("Le nom est obligatoire");
    }

    if(strtotime($release_date) === false) {
        die("La date n'est pas au bon format");
    }


    // --- END OF YOUR CODE ---
    
    // Insertion en DB du jeu video
    $insertQuery = "
        INSERT INTO videogame (name, editor, release_date, platform_id)
        VALUES ('{$name}', '{$editor}', '{$release_date}', {$platform})
    ";
    // TODO #3 exécuter la requête qui insère les données
    
       $new = $pdo->exec($insertQuery);
     
    // TODO #3 une fois inséré, faire une redirection vers la page "index.php" (fonction header)
    // --- START OF YOUR CODE --
    
   // if($new != 1) {
   //     die("You loose ! Try again !");
   // } else {
   //     header("Location:index.php");
    //}


    // --- END OF YOUR CODE ---
//}

          header('Location: index.php');


    // --- END OF YOUR CODE ---
   }

// Liste des consoles de jeux
// TODO #4 (optionnel) récupérer cette liste depuis la base de données
// --- START OF YOUR CODE ---
$platformList = array(
    1 => 'PC',
    2 => 'MegaDrive',
    3 => 'SNES',
    4 => 'PlayStation'
);






         




// --- END OF YOUR CODE ---

// TODO #1 écrire la requête SQL permettant de récupérer les jeux vidéos en base de données (mais ne pas l'exécuter maintenant)
// --- START OF YOUR CODE ---
$sql = '
SELECT * FROM videogame
'
;


// --- END OF YOUR CODE ---

// Si un tri a été demandé, on réécrit la requête
if (!empty($_GET['order'])) {
    // Récupération du tri choisi
    $order = trim($_GET['order']);
    if ($order == 'name') {
        // TODO #2 écrire la requête avec un tri par nom croissant
        // --- START OF YOUR CODE ---
        $sql = '
            SELECT * FROM videogame
            ORDER BY name ASC
        ';
        var_dump($sql);
        // --- END OF YOUR CODE ---
    }
    else if ($order == 'editor') {
        // TODO #2 écrire la requête avec un tri par editeur croissant
        // --- START OF YOUR CODE ---
        $sql = '
            SELECT * FROM videogame 
            ORDER BY editor ASC
        ';
        var_dump($sql);
        // --- END OF YOUR CODE ---
    }
}
// TODO #1 exécuter la requête contenue dans $sql et récupérer les valeurs dans la variable $videogameList
// --- START OF YOUR CODE ---

//$videogameList=$pdo->query("SELECT * FROM videogame");
//$videogame = $videogameList->fetchall(PDO::FETCH_ASSOC);
// j'execute la requete puis je récupère l'objet PDOstatement qui contienrt les resultats
$stmtvideogame = $pdo->query($sql);

// je stock tous les résultats d'un coup avec fletchall dans un tableau associatif (PDO::FETCH_ASSOC);
$resultat = $stmtvideogame->fetchAll(PDO::FETCH_ASSOC);

// on boucle sur chaque ligne du tableau de résulat
foreach($resultat as $result){
   $id = $result['id'];
   $platform = $result['name'];

   // je recré mon tableau qui était sous la forme  [ID => NAME]
   $platformList[$id] = $name;

}






// --- END OF YOUR CODE ---

// Inclusion du fichier s'occupant d'afficher le code HTML
// Je fais cela car mon fichier actuel est déjà assez gros, donc autant le faire ailleurs (pas le métier hein ! ;) )
require __DIR__.'/view/videogame.php';
