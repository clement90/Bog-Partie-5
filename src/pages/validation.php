<?php
$titre = "Validation de votre compte";
require "../../src/common/template.php";
require '../../src/fonctions/dbAccess.php';
require "../../src/fonctions/validationFonction.php";
if(isset($_GET["validation"])){
    $codeValidation = $_GET["validation"];
    activationCompte($codeValidation);
}
?>
<h2 class="registerOk">Votre compte a bien été validé, vous pouvez vous <a href="../../src/pages/login.php">Connecter</a></h2>

<?php
require "../../src/common/footer.php"
?>