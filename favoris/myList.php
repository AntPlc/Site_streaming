<!-- PHP page admin -->

<?php require_once '../inc/header.php';

$requete=executeRequete('SELECT * FROM upload');
$uploads=$requete->fetchAll(PDO::FETCH_ASSOC);
?>

<?php

$detail = getFullList();

if(isset($_GET['remove'])):
    remove($_GET['remove']);

    header('location:./myList.php');
    exit();
endif;

if(isset($_GET['destroy'])):
    destroy();

    header('location:../');
    exit();
endif;

if(isset($_GET['order'])):
    $resultat = executeRequete("INSERT into mylist (id_user) VALUES (:id_user)", array(
        ':id_user' => $_SESSION['user']['id'],
        )
    );

    $id = $resultat;
    foreach(getFullList() as $item):
        executeRequete("INSERT into details (id_mylist, id_upload) VALUES  (:id_mylist, :id_upload)", array(
            ':id_mylist' => $item['mylist']['id'],
            ':id_upload' => $item['upload']['id']
        ));
        remove($item['upload']['id']);
    endforeach;

    header('location:../');
    exit();

endif;



if(count($mylist['id']) == 0):

?>
    
<h3 class="alert alert-warning text-center">Votre liste est vide, ajoutez vos videos favorites <a class="hover" href="<?= SITE ; ?>">sur la page d'accueil !</a></h3>
    
<?php else: ?>
<div class="d-flex justify-content-end">
    <a href="?destroy=1"><button class="btn btn-outline-danger btn-rounded ">Supprimer toute la liste</button></a>
</div>
<style>
    .scroller{
        height: 40%;
        overflow-y: scroll;
        scrollbar-width: thin;
    }
</style>
<h1>My List</h1>
<div class="row">
<?php foreach ($detail as $item):
?>
    <div class="mb-3 col-md-4" style="max-width: 20rem;" id="<?= $item['upload']['id'] ?>">
        <h4 class="text-white"><?=  $item['upload']['name'] ; ?></h4>
        <img style="height: 170px; width: 100%;" src="<?=  SITE . $item['upload']['picture'] ; ?>" alt="">
        <p class="scroller"><?=  $item['upload']['description'] ; ?></p>

        <!-- btn supprimer -->
        <a href="?remove=<?=  $item['upload']['id'] ; ?>"><button class="btn btn-primary text-white">Delete from my list</button></a>
    </div>
<?php  endforeach; ?>
</div>
<?php endif; 
require_once '../inc/footer.php'; ?>


<!-- -------------------------------------------------------------------------------------------------- -->

<?php

$details = getFullCart();

if(isset($_GET['add'])):
    add($_GET['add']);

    header('location:./fullCart.php');
    exit();
endif;

if(isset($_GET['remove'])):
    remove($_GET['remove']);

    header('location:./fullCart.php');
    exit();
endif;

if(isset($_GET['destroy'])):
    destroy();

    header('location:../');
    exit();
endif;
