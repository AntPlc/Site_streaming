<?php require_once '../inc/init.php';   ?>
<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>STREAMLABS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/5.1.3/lux/bootstrap.min.css" integrity="sha512-B5sIrmt97CGoPUHgazLWO0fKVVbtXgGIOayWsbp9Z5aq4DJVATpOftE/sTTL27cu+QOqpI/jpt6tldZ4SwFDZw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= SITE . 'css/login.css'; ?>">
    <link rel="icon" type="image/png" href="./img-vid/streamlabs-obs.png" sizes="16x16" />
</head>


<?php if (isset($_SESSION['messages']) && !empty($_SESSION['messages'])):
  foreach ($_SESSION['messages'] as $type => $mess):
    foreach ($mess as $key => $message):?>

      <div class="alert alert-<?= $type; ?> text-center">
        <p><?= $message; ?></p>
      </div>
      <?php unset($_SESSION['messages'][$type][$key]); ?>
    <?php endforeach; 
  endforeach; 
endif; ?>


<!-- PHP page login.php -->

<?php 


// Indentification à partir du mail: 
if(!empty($_POST)):
    $resultat=executeRequete(" SELECT * FROM user WHERE email=:email", 
    array(':email'=>$_POST['email']
    ));
    
    // session existante: 
    if($resultat->rowCount() == 1):
        $user=$resultat->fetch(PDO::FETCH_ASSOC);

        // verif mdp: 
        if(password_verify($_POST['password'],$user['password'])):
            $_SESSION['user']=$user;
            $_SESSION['messages']['success'][]="Vous êtes à présent connecté.e";
            header('location:../'); 
            exit();
        else: 
            $_SESSION['messages']['danger'][]="Erreur sur le mot de passe";
            header('location:./login.php');
            exit();
        endif; // fin verif mdp

    //la session n'existe pas: 
    elseif($resultat->rowCount() == 0):
        $_SESSION['messages']['danger'][]="Il n'existe pas de compte relié à cette adresse mail";
        header('location:./login.php');
        exit();

    // une erreur est survenue 
    elseif($resultat->rowCount() > 1):
        $_SESSION['messages']['danger'][]="Une erreur est survenue; merci de contacter l'administrateurice du site";
        header('location:./login.php'); 
        exit();

    endif; //fin if($resultat->rowCount() == 1):
endif; //fin ident. mail

?>

<body>
  <div id="particles-js"></div>

  <section class="login">
      <div class="container">
          <div class="login-container-wrapper clearfix">
              <div class="welcome"><strong>Sign In :</strong></div>

              <form method="post" action="" class="form-horizontal login-form">
                  <div class="form-group relative email">
                      <input name="email" id="email" class="form-control input-lg" type="email" placeholder="Email">
                  </div>
                  <br>
                  <div class="form-group relative password">
                      <input name="password" id="login" class="form-control input-lg" type="password" placeholder="Password">
                  </div>
                  <div class="form-group text-center">
                      <label> <a class="forgot" href="forgot_password.php" title="forgot">Forgot your password ? Click here</a> </label>
                  </div>
                  <br>
                  <div class="form-group">
                      <button type="submit" class="btn btn-success btn-lg btn-block">Login</button>
                  </div>
                  <br>
                  <div class="form-group text-center">
                      <label> <a class="loggin" href="register.php" title="login">Don't have an account ? Register now !</a> </label>
                  </div>
              </form>
          </div>
      </div>

        </section>
</body>

</html>


<?php require_once '../inc/footer.php' ?>
