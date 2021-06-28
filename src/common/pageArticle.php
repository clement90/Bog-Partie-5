<!-- importer nouveau style pour les articles -->

<link rel="stylesheet" href="../css/article.css">
<link rel="stylesheet" 
    media="only screen and (max-width: 1266px)"
    href="../css/mobileArticle1266px.css">
<link rel="stylesheet" 
    media="only screen and (max-width: 1100px)"
    href="../css/mobileArticle1100px.css">

<?php

    $titre = "Belgium Video Gaming";
    require "../../src/common/template.php";
    require "../../src/fonctions/dbAccess.php";
    require "../../src/fonctions/afficherArticleDbFonctions.php";
    

    //Je récupère l'id qui est fournie par mon get
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        //J'envoie l'entier de ma valeur dans une variable id
        $id = intval($_GET["id"]);
        //J'execute une requete pour récuperer mon contenu
        $contenuArticle = getArticleContent($id);
        /* var_dump($contenuArticle); */
    }
?>

<!-- Composer le header de mon arrticle -->
<section class="headerArticle">

    <!-- 1ere partie avec la voer de mon jeu -->
    <?php
        if($contenuArticle[0]["cover"]){
            ?>
            <div>
            
                <img src="<?= $contenuArticle[0]["cover"]?>" alt="cover du jeu">
            </div>
            <?php
        }else{
            ?>
            <div></div>
            <?php
        }
        //
    ?>
    <!-- Les informatiosn du jeu cité dans l'article -->
    <div class="infoJeu">
        <h2><?= $contenuArticle[0]["nom"]?></h2><?= $contenuArticle[0]["console"]?>
        <p>
            Genre : <?= $contenuArticle[0]["genre"]?> | Editeur <?= $contenuArticle[0]["editeur"]?> | Développeur
            <?= $contenuArticle[0]["developpeur"]?> | Disponible <?= substr($contenuArticle[0]["dateDeSortie"],0,10)?> 
            | Auteur : <?= $contenuArticle[0]["auteurNom"]?> <?= $contenuArticle[0]["auteurPrenom"]?>
        </p>
    </div>

</section>

<section class="monArticle">

        <!-- Intégralité de mon article sur le quel le flex principale est appliqué -->
        <div class="article">
            <!-- la section qui contien l'image et le titre -->
            <div class="background" style="background: url(<?= $contenuArticle[0]["imgUrl"]?>) center center/cover; min-height: 50vh"> 
                <div class="titreArticle">
                    <h1><?= $contenuArticle[0]["titre"]?></h1>
                </div>

                
            </div>
            <!-- Le contenu de mon article -->
            <div class="contenuArticle">
                <?= $contenuArticle[0]["content"]?>
            </div>

            <!-- J'injecterais les commentaires de mes users -->
            <?php
            require "../../src/pages/articlesIncludes/commentaires.php";
            ?>
        </div>

        <?php
        require "../../src/pages/articlesIncludes/listeDerniersArticles.php";
        ?>
        

</section>

<?php
    
    require "../../src/common/footer.php";
?>