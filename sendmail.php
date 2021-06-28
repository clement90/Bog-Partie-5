<?php
$dest = "drynnaea@gmail.com";
$sujet = "Email de test";
$corp = "http://localhost/src/pages/register.php?confirmation=true";
$headers = "From: drynnaea@gmail.com";
if (mail($dest, $sujet, $corp, $headers)){
    echo "Mail encoyé avec succès à $dest ...";
}else{
    echo "Echec de l'envoie de l'email";
}
?>