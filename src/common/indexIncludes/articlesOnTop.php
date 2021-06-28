<?php
//Récuperer la liste des dernier articles
require "./src/fonctions/articlesDbFonctions.php";
$listeArticlesOnTop = getTOp();
?>

<div class="articleOnTop">
    <h2>Les articles mis en avant</h2>

    <?php
    for($i=0; $i<count($listeArticlesOnTop); $i++){
        $titreArticle = substr($listeArticlesOnTop[$i]["titre"], 0, 49) . '...';
        ?>
        <div>
                <img src="<?= $listeArticlesOnTop[$i]["cover"]?>" alt="image de présentation du jeu">
                <h2><a href="../../src/common/pageArticle.php?id=<?= $listeArticlesOnTop[$i]["articleId"]?>"><?= $titreArticle?></a></h2>
        </div>
        <?php
    }

    ?>
</div>