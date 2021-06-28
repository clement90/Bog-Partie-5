<?php

//Vérifier si c'est une personne connecté ou non
if(isset($_SESSION["user"])){
    $pseudo = $_SESSION["user"]["login"];
$photo = $_SESSION["user"]["photo"];
$userId = $_SESSION["user"]["id"];
}else{
    /* SANITIZE LE PSEUDO */
    if(isset($_POST["pseudo"]) && !empty($_POST["pseudo"])){
        $pseudo = htmlspecialchars($_POST["pseudo"]);
        $pseudo = filter_var($pseudo, FILTER_SANITIZE_STRING);
        $userId = NULL;
    }
}

require "../../src/fonctions/commentairesDbfonctions.php";

if(isset($_POST["commentaire"]) && !empty($_POST["commentaire"])){
    /* SANITIZE LE CONTENT */
    $content = htmlspecialchars($_POST["commentaire"]);
    $content = filter_var($content, FILTER_SANITIZE_STRING);
    setComment($id, $userId, $pseudo, $content);
}

//Récuperer la liste des commentaire correspondant a l'article
$listCommentaires = getComment($id);

?>


<hr>
<section class="commentaires">
    <table>
        <form action="" method="POST">
            <thead>
                <tr>
                    <td>Commentez cet article</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    //si l'utilisateur est connecté on reprend son image sinon on lui en attribue une par défaut
                    if(isset($_SESSION["user"])){
                        ?>
                    <td><p><img src="<?= $photo?>" alt="photo de l'user" style="max-width: 100px;"></p></td>
                <tr>
                    <td><?= $pseudo?></td>
                </tr>
                        <?php
                    }else{
                        ?>
                        <td><input type="text" name="pseudo" placeholder="Entrez votre pseudo"></td>
                        <?php
                    }
                    ?>
                </tr>
                <tr>
                    <td><textarea name="commentaire" id="commentaire" cols="30" rows="10" placeholder="Entrez votre commentaire..."></textarea></td>
                </tr>
                <tr>
                    <td><input type="submit" value="Envoyer votre commentaire"></td>
                </tr>
            </tbody>
        </form>
    </table>

    <section class="afficherCommentaire">
    <?php
    //Afficher la liste des commentaires de l'article
    if(!empty($listCommentaires)){
        for($i = 0; $i < count($listCommentaires); $i++){
            if(isset($listCommentaires[$i]["auteurId"])){
                $avatar = getAvatar($listCommentaires[$i]["auteurId"]);
            }else{
                $avatar = "../../src/img/site/defaut_avatar.png";
            }
            ?>
            <div>
                <div class="enteteCommentaire">
                    <img src="<?= $avatar?>" alt="avatat de l'user">
                    <p style="margin: auto 1em;"><?= $listCommentaires[$i]["pseudo"]?><br><?= $listCommentaires[$i]["dateCommentaire"]?></p>
                </div>
                <div class="contenuCommentaire">
                        <p><?= $listCommentaires[$i]["contenu"]?></p>
                </div>
            </div>
            <?php

        }
    }
    ?>
    </section>
</section>
