<?php
//Vérifier si le user est bien admin
if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
    //Effacer un article
    if(isset($_GET["delete"]) && $_GET["delete"] == true){
        $articleId = intval($_GET["value"]);
        deleteArticle($articleId);
    }
    
}
$listeArticlesAdmin = getListeArticles();
?>

<h2 class="ta-c mt-5">Listes des Articles</h2>
<table class="mlr-a mt-3 p-1">
    <thead>
        <tr>
            <th  class="p-1" colspan="9" style="text-align: center">Liste des articles</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Titre</td>
            <td>date</td>
            <td>Auteur</td>
            <td>Jeux</td>
            <td>Console</td>
            <td>Catégorie</td>
            <td>A la une</td>
            <td>Supprimer</td>
        </tr>
        <?php
        if(isset($listeArticlesAdmin)){
        for($i=0; $i<count($listeArticlesAdmin); $i++){
            if($listeArticlesAdmin[$i]["star"] == TRUE){
                $star = "oui";
            }else{
                $star = "non";
            }


            ?>
            <tr>
                <td><a href="../../src/common/pageArticle.php?id=<?= $listeArticlesAdmin[$i]["articleId"]?>"><?= $listeArticlesAdmin[$i]["titre"]?></a></td>
                <td><?= $listeArticlesAdmin[$i]["date"]?></td>
                <td><?= $listeArticlesAdmin[$i]["login"]?></td>
                <td><?= $listeArticlesAdmin[$i]["nom"]?></td>
                <td><?= $listeArticlesAdmin[$i]["console"]?></td>
                <td><?= $listeArticlesAdmin[$i]["nomCategorie"]?></td>
                <td><?= $star?></td>
                <td class="ta-c tc-r"><a href="../../src/pages/admin.php?choix=listeArticle&delete=true&value=<?=$listeArticlesAdmin[$i]["articleId"]?>"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            <?php
        }
    }
        ?>
    </tbody>
</table>