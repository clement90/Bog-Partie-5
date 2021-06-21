<?php
    require "../../src/pages/redacArticlesInclude/traitementTamponLiens.php";
    // encapsuler la liste des jeux dans une variable
    $listeJeu = getListGame();
    // encapsule données liste du hardware
    $listeHard = getHard();
    // Liste des catégories d'articles
    $listeGenre = getGenre();
    // type d'articles
    $listeTypeArticle = getCategorie();
?>

<!-- Formulaire de création d'article -->

<section class="articles">
    <form action="" method="post" enctype="multipart/form-data">
        <p>Titre de votre article</p>
        <input type="text" name="titre">
        <p>Image de référence : </p>
        <input type="file" name="fichier">
        <table>
            <tr>
                <td>Jeu concerné</td>
                <td>Console</td>
                <td>Genre</td>
                <td>Type d'article</td>
                <td>A la une?</td>
            </tr>
                <td>
                    <select name="jeu">
                        <?php
                            /* Boucle for pour créer mes options dynamiquement */
                            for($i = 0; $i < count($listeJeu); $i++){
                                ?>
                                    <option value="<?= $listeJeu[$i]["nom"]?>"><?= $listeJeu[$i]["nom"]?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="console">
                        <?php
                            /* Boucle for pour créer mes options dynamiquement */
                            for($i = 0; $i < count($listeHard); $i++){
                                ?>
                                    <option value="<?= $listeHard[$i][1]?>"><?= $listeHard[$i][1]?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="genre">
                        <?php
                            /* Boucle for pour créer mes options dynamiquement */
                            for($i = 0; $i < count($listeGenre); $i++){
                                ?>
                                    <option value="<?= $listeGenre[$i][1]?>"><?= $listeGenre[$i][1]?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <select name="typeArticle">
                        <?php
                            /* Boucle for pour créer mes options dynamiquement */
                            for($i = 0; $i < count($listeTypeArticle); $i++){
                                ?>
                                    <option value="<?= $listeTypeArticle[$i]?>"><?= $listeTypeArticle[$i]?></option>
                                <?php
                            }
                        ?>
                    </select>
                </td>
                <td>
                    <input type="checkbox" name="star">
                </td>
            <tr>

            </tr>
        </table>
        <p>Composer votre article</p>
        <textarea name="contenu" id="contenu"></textarea>
        <input class="btnTampon" type="submit" value="Envoyer votre article">
    </form>
</section>

<!-- Ajout du script tinymce et activer options -->
<script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist image imagetools media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
      toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
   });
</script>