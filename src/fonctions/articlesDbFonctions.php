<?php
    //Fonction pour créer un nouvel article
    function envoyerArticle($titre, $imgUrl, $content, $date, $categorieId, $gameCategoryId, $auteurId, $gameId, $hardId, $star){
        //Traitement de l'image envoyée
        $traiterImage = sendImg($imgUrl, "article");

        //Récuperer l'id de la catégorie d'article qui correspond à la selection de l'auteur
        $arrayCategorieId = getTypeArticleByName($categorieId);
        
        //J'envoie l'index récupéré dans une nouvelle variable
        $categorieId = $arrayCategorieId[0];

        // Récuperer id catégorie
        $arrayGameCategoryId = getGameCategoryByName($gameCategoryId);
        $gameCategoryId = $arrayGameCategoryId[0];
        
        //Récuperer l'id du jeu
        $arrayGameName = getGameByName($gameId);
        $gameId = $arrayGameName[0][0];

        // Récupérer l'id HArdware
        $arrayHardware = getHardByNAme($hardId);
        $hardId = intval($arrayHardware[0][0]);
        //Envoyer article dans DB
        $bdd = dbAccess();
        $requete = $bdd->prepare("INSERT INTO articles(titre, imgUrl, content, date, categorieId, gameCategorieId, auteurId, gameId, hardId, star)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $requete->execute(array($titre, $traiterImage, $content, $date, $categorieId, $gameCategoryId, $auteurId, $gameId, $hardId, $star)) or die(print_r($requete->errorInfo(), TRUE));
        $requete->closeCursor();
        
        //Vérifier si star est actif ou pas
        if($star == true){
            //Envoyer l'article a la une dans la table star
            aLaUne($titre);
        }
    }

    function aLaUne($valeur){
        $bdd = dbAccess();
        $requete = $bdd->prepare("SELECT articleId FROM articles
                                    WHERE titre = ?");
        $requete->execute(array($valeur)) or die(print_r($requete->errorInfo(), TRUE));
        while($donnees = $requete->fetch()){
            $articleId = $donnees[0];
        }
        $requete = $bdd->prepare("INSERT INTO stars(articleId) VALUES(?)");
        $requete->execute(array($articleId)) or die(print_r($requete->errorInfo(), TRUE));
        $requete->closeCursor();
    }
    //Obtenir tout les 12 derniers articles stars
    function getTOp(){
        $bdd = dbAccess();
        $requete = $bdd->query("SELECT a.articleId, a.titre, j.cover
                                FROM articles a
                                INNER JOIN jeux j ON j.gameId = a.gameId
                                INNER JOIN stars s ON s.articleId = a.articleId
                                WHERE s.articleId = a.articleId
                                ORDER BY a.date DESC LIMIT 12 ");
        while($donnees = $requete->fetch()){
            $listArticlesOnTop[] = $donnees;
        }
        return $listArticlesOnTop;
    }

    //Obtenir tout les articles
    function getListeArticles(){
        $bdd = dbAccess();
        $requete = $bdd->query("SELECT a.articleId, a.titre, a.date, c.nomCategorie, u.login, j.nom, h.console, a.star
                                FROM articles a
                                INNER JOIN categorie c ON c.categorieId = a.categorieId
                                INNER JOIN users u ON u.userId = a.auteurId
                                INNER JOIN jeux j ON j.gameId = a.gameId
                                INNER JOIN hardware h ON h.hardId = a.hardId
                                ORDER BY a.date DESC") or die(print_r($requete->errorInfo(), TRUE));
        while($donnees = $requete->fetch()){
            $listeArticleAdmin[] = $donnees;
        }
        return $listeArticleAdmin;
    }

    //Effacer un article
    function deleteArticle($articleId){
        $bdd = dbAccess();
        $requete = $bdd->prepare("DELETE FROM articles
                                    WHERE articleId = ?");
        $requete->execute(array($articleId)) or die(print_r($requete->errorInfo(), TRUE));
        $requete->closeCursor();
    }
?>