<!-- Formulaire de création d'article -->
<section class="articles">
    <form method="post" action="" enctype="multipart/form-data">
        <p>Titre de votre article</p>
        <input type="text" name="titre" >
        <p>Image de référence</p>
        <input type="file" name="fichier">
        <p>Composez votre article</p>
        <textarea name="contenu" id="contenu"> </textarea>
        <input type="submit" value="Envoyez votre article">
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