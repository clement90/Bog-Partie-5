<?php
$listeCommentaires = getAllComment();
?>

<h2 class="ta-c mt-5">Listes des commentaires</h2>
<table class="mlr-a mt-3 p-1">
    <thead>
        <tr>
            <th  class="p-1" colspan="5" style="text-align: center">Liste des commentaires</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Article</td>
            <td>Pseudo</td>
            <td>date</td>
            <td>contenu</td>
            <td>Supprimer</td>
        </tr>
        <?php
        for($i=0; $i<count($listeCommentaires); $i++){
            ?>
            <tr>
                <td><?= $listeCommentaires[$i]["titre"]?></td>
                <td><?= $listeCommentaires[$i]["pseudo"]?></td>
                <td><?= $listeCommentaires[$i]["dateCommentaire"]?></td>
                <td><?= $listeCommentaires[$i]["contenu"]?></td>
                <td class="ta-c tc-r"><a href="../../src/pages/admin.php?choix=listeCommentaires&delete=true&value=<?=$listeCommentaires[$i]["commentaireId"]?>"><i class="far fa-trash-alt"></i></a></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>