<?php
function activationCompte($codeValidation){
    $bdd= dbAccess();
    $requete = $bdd->prepare("UPDATE users
                                SET actif = 1
                                WHERE codeValidation = ?");
    $requete->execute(array($codeValidation)) or die(print_r($requete->errorInfo(), TRUE));
    $requete->closeCursor();
}
?>