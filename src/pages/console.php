<?php
    $titre = "BELGIUM VIDEO-GAMING " . $_GET["choix"];
    $console = $_GET["choix"];
    require "../../src/common/template.php";
    require "../../src/fonctions/dbAccess.php";
    require "../../src/fonctions/consoleDbFonctions.php";
    $listeConsoleArticles = getArticlesConsole($console);
    
?>
<link rel="stylesheet" href="artice.css">
<h2 class="mb-2 ml-9 mt-3"><?= $console?></h2>
<section class="moreNewsSection">
    <div class="moreNews">
        <?php
            if(isset($listeConsoleArticles) ){
                for($i=0; $i<count($listeConsoleArticles); $i++){
                    $contenu = substr(strip_tags($listeConsoleArticles[$i]["content"]), 0, 250) . "...";
                    ?>
                    <div class="cardNews moreNews-row-item">
                        
                        <img src="<?=$listeConsoleArticles[$i]["imgUrl"]?>" alt="image d'ilustration">
                        <div><a href="/src/common/pageArticle.php?id=<?= $listeConsoleArticles[$i]["articleId"]?>">
                            <h2><?= $listeConsoleArticles[$i]["titre"]?></h2>
                            <p><?= $contenu?></p>
                            <p><?= $listeConsoleArticles[$i]["date"]?></p></a>
                        </div>
                        
                    </div>
                    <hr>    
                    <?php
                }
            }else{
            ?>
            <h2 class="mb-2 ml-9 mt-3">Il n'existe pas encore de jeu pour cette console!</h2>
            <?php 
            }
        ?>
    </div>
    <?php
    /* require ""; */
    ?>
</section>
<?php
    require "../../src/common/footer.php";
?>