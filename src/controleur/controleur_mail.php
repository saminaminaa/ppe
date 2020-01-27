<?php
// Le message
$message = "Bonjour unUtilisateur.nom \r\"
    .Vous possedez un compte sur le site Devdev avec l'adresse email unUtilisateur.email"
        . "\r\Il est important que vous validiez votre email. Sans cette validation, votre compte sera supprimé au bout de 24h"
        ."\r\Cliquez donc sur le lien ci-dessous pour valider votre adresse email"
        ."\r\Cordialement"
        ."\r\L'équipe Devdev";

// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
$message = wordwrap($message, 70, "\r\n");

// Envoi du mail
mail('unUtilisateur.email', 'Validation de votre adresse mail', $message);
?>
