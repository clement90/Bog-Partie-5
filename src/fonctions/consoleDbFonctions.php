<?php
function getArticlesConsole($console){
    $bdd = dbAccess();
    $requete = $bdd->prepare("SELECT a.imgUrl, a.titre, a.content, a.date, a.articleId
                            FROM articles a
                            INNER JOIN hardware h ON h.hardId = a.hardId
                            WHERE h.console = ?
                            ORDER BY a.date DESC");
    $requete->execute(array($console)) or die(print_r($requete->errorInfo(), TRUE));
    while($donnees = $requete->fetch()){
        $listeArticlesConsole[] = $donnees;
    }
    $requete->closeCursor();
    
    if(isset($listeArticlesConsole)){
    return $listeArticlesConsole;}
    
}
?>