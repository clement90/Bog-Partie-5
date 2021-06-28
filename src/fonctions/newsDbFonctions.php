<?php

    // Récuperer les articles a la une
    function getArticleOnTop(){
        $bdd = dbAccess();
        $requete = $bdd->query("SELECT a.articleId, a.titre, a.imgUrl, a.content, a.date, c.nomCategorie, gc.genre, u.nom, u.prenom 
                                FROM articles a
                                INNER JOIN categorie c ON c.categorieId = a.categorieId
                                INNER JOIN gameCategory gc ON gc.gameCategoryId = a.gameCategorieId
                                INNER JOIN users u ON u.userId = a.auteurId
                                INNER JOIN jeux j ON j.gameId = a.gameId
                                INNER JOIN hardware h ON h.hardId = a.hardId
                                INNER JOIN stars s ON s.articleId = a.articleId
                                WHERE s.articleId = a.articleId
                                ORDER BY starId DESC LIMIT 3");
        while($donnees = $requete->fetch()){
            $listOnTop[] = $donnees;
        }

        return $listOnTop;
    }
/* Récuperer les articles pour liste */
    function getLastArticles(){
        $bdd = dbAccess();
        $requete = $bdd->query("SELECT a.articleId, a.titre, j.cover
                                FROM articles a
                                INNER JOIN jeux j ON j.gameId = a.gameId
                                ORDER BY a.date DESC LIMIT 12");
        while($donnees = $requete->fetch()){
            $listLastArticle[] = $donnees;
        }
        return $listLastArticle;
    }

    // Récuperer tout les articles 
    function getAllArticles(){
        $bdd = dbAccess();
        $requete = $bdd->query("SELECT a.articleId, a.titre, a.imgUrl, a.content, a.date
                                FROM articles a
                                ORDER BY a.date DESC");
        while($donnees = $requete->fetch()){
            $listAll[] = $donnees;
        }
        return $listAll;
    }
?>