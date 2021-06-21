<style>

    /* Section upload */
    .recapUpload{
        width: 40%;
        margin: 1rem auto;
        /* border: 1px solid black; */
        padding: 1rem;
    }

    .recapUpload > img{
        width: 80%;
        margin-left: auto;
        margin-right: auto;
        border: 1px green solid;
        padding: 0.3rem;
    }

    /* formulaire */
    .formulaire{
        border: 1px solid black;
        margin-left: 2rem;
        margin-top: 2rem;
        padding: 1rem;
        width: 30%;
        box-shadow: 0px 10px 13px -7px black, 1px 2px 3px 3px rgba(0,0,0,0);
    }

    /* Section liste images */
    .liste{
        background: rgb(0,0,0);
        background: linear-gradient(117deg, rgba(0,0,0,1) 10%, rgba(255,247,0,1) 44%, rgba(255,10,10,1) 95%);
        border-top: 2px solid blue;
        margin-top: 2rem;
        padding-top: 2rem;
        text-align: center;
        color: white;
        box-shadow: 0px 10px 13px -7px black, 1px 2px 3px 3px rgba(0,0,0,0);

    }
    .miseEnPage{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .image{
        width: 10rem;
        margin: 1rem;
        padding: 0.5rem;
        border: solid 1px black;
        background-color: white;
    }
    .image > a > img{
        width: 100%;
        height: 10rem;
        box-shadow: 0px 10px 13px -7px #000000, -6px -3px 4px 5px rgba(0,0,0,0);
        margin-bottom: 1rem;
        border: solid 3px green;

    }

    .image > a > p{
        text-align: center;
        color: black;
    }
</style>

<?php
    //traiter l'envoie du fichier
    if(isset($_FILES["fichier"]) && $_FILES["fichier"]["error"] ==0){
        //Vérifier si la taille du fichier recu est inférieur a 10Mo
        if($_FILES["fichier"]["size"] <= 10000000){
            //Créer un tableau pour stocker les extensions de fichier autorisé
            $extensionArray = ["png","PNG", "gif", "GIF", "jpg", "JPG", "jpeg", "JPEG", "jfif", "JFIF"];
            //Récupérer toutes les infos du fichier
            $infoFichier = pathinfo($_FILES["fichier"]["name"]);
            //Je récupère l'extension di fichier qui a été envoyer
            $extensionImage = $infoFichier["extension"];
            //Extension est autorisée?
            if(in_array($extensionImage, $extensionArray)){
                //préparer le chemin de réception de mon image
                $dossier = "../../src/img/article/" . time() . basename($_FILES["fichier"]["name"]);
                //envoyer mon fichier
                move_uploaded_file($_FILES["fichier"]["tmp_name"], $dossier);
                //indiquer a mon user que l'upload c'est bien passé
                ?>
                <div class="recapUpload">
                <h4>Envoie du fichier <?= $_FILES["fichier"]["name"]?> réussi!!</h4>
                <img src="<?= $dossier?>" alt="fichier envoyer" class="nouvelUpload">
                </div>
                <?php
                if(isset($_POST["tampon"]) && $_POST["tampon"] == "oui"){
                    $bdd =dbAccess();
                    $requete = $bdd->prepare("INSERT INTO tampon(liens, auteurId)
                                                VALUES (?,?)");
                    $requete->execute(array($dossier, $_SESSION["user"]["id"]));
                    $requete->closeCursor();
                }

            } else{
                header("location: ../../src/pages/articles.php?choix=uploaderPhoto&error=true&message=Extension non autorisée");
                exit();
            }
        }
    }
?>

<div class="formulaire">
    <form action="" method="post" enctype="multipart/form-data">
        <?php
            if(isset($_GET["error"]) && $_GET["error"] == TRUE){
                ?>
                <h3><?= $_GET["message"]?></h3>
                <?php
            }
        ?>
        <h4>Uplaoder un fichier</h4>
        <table>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
            <tr>
                <td><input type="file" name="fichier"></td>
            </tr>
            <tr>
                <td><select name="tampon">
                <option value="oui">OUI</option>
                <option value="non">NON</option>
                </select></td>
            </tr>
            <tr>
                <td><input type="submit" value="Envoyer image"></td>
            </tr>

        </table>
    </form>
</div>