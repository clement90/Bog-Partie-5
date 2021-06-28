<?php


$listeAllArticles = getAllArticles();

?><h2 class="mb-2 ml-9 mt-3">Plus de news...</h2>
<section class="moreNewsSection">
    
    <div class="moreNews">
        <?php
        for($i=0; $i<count($listeAllArticles); $i++){
            $contenu = substr(strip_tags($listeAllArticles[$i]["content"]), 0, 250) . "...";
            
            ?>
            <div class="cardNews moreNews-row-item">
                
                <img src="<?=$listeAllArticles[$i]["imgUrl"]?>" alt="image d'ilustration">
                <div><a href="/src/common/pageArticle.php?id=<?= $listeAllArticles[$i]["articleId"]?>">
                    <h2><?= $listeAllArticles[$i]["titre"]?></h2>
                    <p><?= $contenu?></p>
                    <p><?= $listeAllArticles[$i]["date"]?></p></a>
                </div>
                
            </div>
        <hr>    
            <?php
        }
        ?>
    </div>
    <?php
    require "./src/common/indexIncludes/articlesOnTop.php";
    ?>
</section>