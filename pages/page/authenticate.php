<?php
    require_once('code/controllers/MailController.php');
    require_once('code/controllers/LoginController.php');

    $loginController = new LoginController();
    $mailController = new MailController();

    if(isset($_POST['checkToken'])){
        if($_SESSION['token'] == $_POST['token']){
            $_SESSION['abc-biker-token'] = 1;
            loadpage($_SESSION['rooturl'] . '/account');
        }else{
            session_destroy();
            echo 'Token komt niet overeen. <a href="'.$_SESSION['rooturl'].'/login">Klik hier om terug te gaan naar de inlogpagina.</a>';
        }
    }else{
        if(!empty($_SESSION['user']['employeenumber'])){
            $_SESSION['token'] = $loginController->passwordGenerator();
            $email = $_SESSION['user']['email'];

            $result = $mailController->sendToken($email, $_SESSION['token']);

            if($result == 'success'){
                showMessage('success','Er is een token naar uw emailadres verstuurd.');
            }else{

                showMessage('danger',$result);
            }

            echo 'Deze token kunt u invullen in het formulier hier onder:

              <form action="#" method="post">
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="token">Token</label>
                        <input type="text" class="form-control" id="token" name="token" value="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <input type="submit" class="form-control" id="checkToken" name="checkToken" class="btn btn-primary" value="Inloggen">
                    </div>
                </div>
              </form>';
        }else{
            showMessage('danger', 'U bent niet gemachtigd om deze pagina te bezoeken.');
        }
    }

