<?php
//Afficher tout les users
function getListeUsers(){
    $bdd = dbAccess();
    $requete = $bdd->query("SELECT u.userId, u.login, u.nom, u.prenom, u.email, r.nomRole
                            FROM    users u
                            INNER JOIN role r ON r.roleId = u.roleId") or die(print_r($requete->errorInfo(), TRUE));
    while($donnees = $requete->fetch()){
        $listeUsers[] = $donnees;
    }
    $requete->closeCursor();
    return $listeUsers;
}
function deleteUser($id){
    $bdd = dbAccess();
    $requete = $bdd->prepare("DELETE FROM users WHERE userId = ?");
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
    $requete->closeCursor();
}
function banUser($id){
    $bdd = dbAccess();
    $requete = $bdd->prepare("UPDATE users 
                                SET ban = NULL 
                                WHERE userId = ?");
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
    $requete->closeCursor();
}
?>