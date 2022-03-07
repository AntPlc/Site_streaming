<?php 

// $panier = $favoris
// ICI SONT LES FONCTIONS

function add(int $id) 
{
    $panier =$_SESSION['fav'];
    //si le panier n'est pas vide, on ajoute au panier:
    if(!empty($panier[$id])):
        $panier[$id]++;
    // sinon on initialise la qutté à 1: 
    else:
        $panier[$id]=1;
    endif;
    // Enfin, on réaffecte la session: 
    $_SESSION['fav']=$panier;
}

function remove(int $id){
    $panier = $_SESSION['fav'];

    if(!empty($panier[$id]) && $panier[$id] !== 1):
        $panier[$id]--;
    else:
        unset($panier[$id]);
    endif;
    $_SESSION['fav'] = $panier;
}

function destroy(){
    unset($_SESSION['fav']);
}
// A REVOIR
function getFullList(){
    $panier = $_SESSION['fav'];
    $panierDetail = [];

    foreach($panier as $id => $upload['id']):
        $resultat = executeRequete("SELECT * FROM upload WHERE id=:id", array(
            ":id" => $id
        ));
        $upload = $resultat -> fetch(PDO::FETCH_ASSOC);
        $panierDetail[] = [
            'upload' => $upload,
            'id_video' => $upload['id'],
        ];
    endforeach;
    return $panierDetail;
}

?>