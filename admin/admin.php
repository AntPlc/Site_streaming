<!-- PHP page admin -->

<?php require_once '../inc/header.php';


$requete=executeRequete('SELECT * FROM upload');
$uploads=$requete->fetchAll(PDO::FETCH_ASSOC);
?>





<?php


//Suppression d'une vidéo : 
if(isset($_GET['id'])):
  // die(var_dump($_GET));
    executeRequete("DELETE FROM upload WHERE id=:id", array(':id'=>$_GET['id'])); 
    $_SESSION['messages']['success'][]='Votre vidéo a bien été supprimée';
    header('location:./admin.php');
    exit();
endif;

//$_SESSION['messages']['success'][]='Votre produit a bien été supprimé'; 
//debug($_SESSION);
//die();
?>

<style>
    .scroller{
        height: 40%;
        overflow-y: scroll;
        scrollbar-width: thin;
    }
</style>
<h1>Videos managment</h1>
<div class="row">
<?php foreach ($uploads as $upload):
?>
    <div class="mb-3 col-md-4" style="max-width: 20rem;" id="<?= 'item'.$upload['id'] ?>">
        <h4 class="text-white"><?=  $upload['name'] ; ?></h4>
        <img style="height: 170px; width: 100%;" src="<?=  SITE.$upload['picture'] ; ?>" alt="">
        <p class="scroller"><?=  $upload['description'] ; ?></p>

        <!-- Boutons modifier / supprimer :  -->
        <a href="<?= SITE. './admin/upload.php?id='. $upload['id']; ?>" class="btn btn-secondary btn-sm">Modify</a>
        <!-- On utilise l'iD du produit  -->
        <a href="?id=<?= $upload['id']; ?>" onclick="return confirm('Etes vous sûr?')" class="btn btn-danger btn-sm">Delete</a>
    </div>
<?php  endforeach; ?>
</div>


<?php require_once '../inc/footer.php' ?>


