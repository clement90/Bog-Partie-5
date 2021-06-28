<?php
//Récuperer la liste des dernier articles
require "../../src/fonctions/newsDbFonctions.php";
$listeDerniersArticle = getLastArticles();

?>

<div class="listArticle">
    <h2>Nos Dernier Articles...</h2>

    <?php
    for($i=0; $i<count($listeDerniersArticle); $i++){
        $titreArticle = substr($listeDerniersArticle[$i]["titre"], 0, 49) . '...';
        ?>
        <div>
                <img src="<?= $listeDerniersArticle[$i]["cover"]?>" alt="image de présentation du jeu">
                <h2><a href="../../src/common/pageArticle.php?id=<?= $listeDerniersArticle[$i]["articleId"]?>"><?= $titreArticle?></a></h2>
        </div>
        <?php
    }

    ?>

</div>