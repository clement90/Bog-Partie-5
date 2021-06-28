<?php
//Vérifier que mon utilisatuer est bien un admin
if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"){
    //Effacer un utilisateur
    if(isset($_GET["delete"]) && $_GET["delete"] == true){
        $userId = intval($_GET["value"]);
        deleteUser($userId);
    }
    if(isset($_GET["ban"]) && $_GET["ban"] == true){
        $userId = intval($_GET["value"]);
        banUser($userId);
    }
}
$listeUsers = getListeUsers();
?>

<h2 class="ta-c mt-5">Listes des utilisateurs</h2>
<table class="mlr-a mt-3 p-1">
    <thead>
        <tr>
            <th  class="p-1" colspan="7" style="text-align: center">Liste des utilisateur</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Role</td>
            <td>Pseudo</td>
            <td>Prénom</td>
            <td>Nom</td>
            <td>Email</td>
            <td>Ban</td>
            <td>Supprimer</td>
        </tr>
        <?php
        for($i=0; $i<count($listeUsers); $i++){
            ?>
            <tr>
                <td><?= $listeUsers[$i]["nomRole"]?></td>
                <td><?= $listeUsers[$i]["login"]?></td>
                <td><?= $listeUsers[$i]["prenom"]?></td>
                <td><?= $listeUsers[$i]["nom"]?></td>
                <td><?= $listeUsers[$i]["email"]?></td>
                <td class="ta-c tc-r"><a href="../../src/pages/admin.php?choix=listeUser&ban=true&value=<?=$listeUsers[$i]["userId"]?>"><i class="fas fa-ban"></i></a></td>
                <td class="ta-c tc-r"><a href="../../src/pages/admin.php?choix=listeUser&delete=true&value=<?=$listeUsers[$i]["userId"]?>"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>