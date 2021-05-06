
<?php

function actionRegion($twig, $db) {
    $utilisateur = new Utilisateur($db);

    $liste = $utilisateur -> selectRegion();
    echo $twig->render('regions.html.twig', array('utilisateur'=> $utilisateur, 'liste' => $liste));
}
?>