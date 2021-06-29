<?php
//Envoyer un commentaire dans la base de donnée
function setComment($articleId, $userId, $pseudo, $content){
    $date = date('Y-m-d H:i:s');
    $bdd = dbAccess();
    $requete = $bdd->prepare("INSERT INTO commentaires(articleId, auteurId, pseudo, dateCommentaire, contenu) VALUES(?,?,?,?,?)");
    $requete->execute(array($articleId, $userId, $pseudo, $date, $content)) or die(print_r($requete->errorInfo(), TRUE));
    $requete->closeCursor();
}
//Obtenir l'avatar de la personne ayant posté le commentaire
function getAvatar($userId){
    $bdd = dbAccess();
    $requete = $bdd->prepare("SELECT avatar FROM users WHERE userId = ?");
    $requete->execute(array($userId)) or die(print_r($requete->errorInfo(), TRUE));
    while($donnes = $requete->fetch()){
        $avatar = $donnes[0];
    }
    return $avatar;
}
//Obtenir les commentaires d'un article
function getComment($articleId){
    $bdd = dbAccess();
    $requete = $bdd->prepare("SELECT * FROM commentaires WHERE articleId = ? ORDER BY dateCommentaire");
    $requete->execute(array($articleId)) or die(print_r($requete->errorInfo(), TRUE));
    while($donnes = $requete->fetch()){
        $listCommentaires[] = $donnes;
    }
    $requete->closeCursor();
    if(!empty($listCommentaires)){
        return $listCommentaires;
    }
}

//Afficher tout les commentaires
function getAllComment(){
    $bdd = dbAccess();
    $requete = $bdd->query("SELECT a.titre, c.pseudo, c.dateCommentaire, c.contenu, c.commentaireId
                            FROM commentaires c
                            INNER JOIN articles a ON a.articleID = c.articleID") or die(print_r($requete->errorInfo(),TRUE));
    while($donnes = $requete->fetch()){
        $listeCommentaires[] = $donnes;
    }
    $requete->closeCursor();
    return $listeCommentaires;
}

function deleteCommentaire($id){
    $bdd = dbAccess();
    $requete = $bdd->prepare("DELETE FROM commentaires WHERE commentaireId = ?");
    $requete->execute(array($id)) or die(print_r($requete->errorInfo(), TRUE));
    $requete->closeCursor();
}
?>