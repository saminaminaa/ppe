
<?php

function actionStatistique($twig, $db) {
    $role = new Role($db);

    $liste = $role -> selectTri();
    echo $twig->render('statistique.html.twig', array('role'=> $role, 'liste' => $liste));
}
?>