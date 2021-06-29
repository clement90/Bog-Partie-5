<?php // Traiter la déconnection du membre
    if(isset($_GET["deconnect"]) && $_GET["deconnect"] == true):
        $_SESSION["connecté"] = false;
        session_destroy();
        header("location: ./index.php");
        exit();
    endif;
    //Récupération de la liste des consoles
    $bdd = new PDO("mysql:host=localhost;dbname=blog-gaming;charset=utf8", "root", "");
    $requete = $bdd->query("SELECT * FROM hardware ORDER BY console") or die(print_r($requete->errorInfo(), TRUE));
    while($donnees = $requete->fetch()){
        $listeConsole[] = $donnees;
    }
    $requete->closeCursor();
?>
<header class="bg">
    <div>
        <a href="../../index.php"><img src="../../src/img/site/logotest.gif" alt="Logo Site Belgium Video-Gaming"></a>
    </div>
    <nav>
        <ul>
        <?php
        for($i=0; $i<count($listeConsole); $i++){
            ?>
            <li><a href="../../src/pages/console.php?choix=<?= $listeConsole[$i]["console"]?>"><?= $listeConsole[$i]["console"]?></a></li>
            <?php
        }
        ?>
            
        </ul>
    </nav>
    <div>
        <nav>
            <?php
                if(!isset($_SESSION["connecté"]) || $_SESSION["connecté"] == false):
            ?>
            <ul>
                <li><a href="../../src/pages/login.php"><i class="fas fa-sign-in-alt"></i>Login</a></li>
                <li><a href="../../src/pages/register.php"><i class="fas fa-user-plus"></i>S'enregistrer</a></li>
            </ul>
            <?php
                endif;
                if(isset($_SESSION["connecté"]) && $_SESSION["connecté"] == true):    
            ?>
            <ul>
                <li><a href="../../src/pages/account.php"><i class="fas fa-user"></i>Mon Compte</a></li>
                <li><a href="../../index?deconnect=true"><i class="fas fa-user-alt-slash"></i>Déconnecter</a></li>
            <?php
                endif;
                if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "auteur" || isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"):    
            ?>
                <li><a href="../../src/pages/articles.php"><i class="fas fa-edit"></i>Rédiger</a></li>
            <?php
                endif;
                if(isset($_SESSION["user"]["role"]) && $_SESSION["user"]["role"] == "admin"):    
            ?>
                <li><a href="../../src/pages/admin.php"><i class="fas fa-user-shield"></i>Admin</a></li>
            <?php
                endif;
                ?>
            </ul>
        </nav>
    </div>
</header>