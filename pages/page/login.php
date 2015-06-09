<?php
    include_once('code/controllers/LoginController.php');

    $loginController = new LoginController();

    $form = '
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="panel panel-login">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <a href="#" class="active" id="login-form-link">Login</a>
                                </div>
                                <div class="col-xs-6">
                                    <a href="'.$_SESSION['rooturl'].'/register" id="register-form-link">Registeer</a>
                                </div>
                            </div>
                            <hr>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form id="login-form" action="#" method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Emailadres" value="">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                        </div>
                                        <div class="form-group text-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember" value="1">
                                            <label for="remember"> Remember Me</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="login" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';

    if(isset($_SESSION['user'])){
        loadpage($_SESSION['rooturl'] . '/home');
    }

    if(isset($_POST['login'])){
        $result = $loginController->authentication($_POST);
        if(!empty($result['employeenumber'])){
            $_SESSION['user'] = $result;

            /*TODO : FIX COOKIE*/
            if(isset($_POST['remember'])){
                setcookie("loginCredentials", $result, time() * 7200); // Expiring after 2 hours
            }else{
                setcookie("loginCredentials", "", time() - 3600); // "Expires" 1 hour ago
            }

            showMessage('succes', 'Welkom: '. $result['employeefirstname'] . ' ' . $result['employeelastname']);
        }else{
            showMessage('danger', 'Het door u ingevoerde emailadres en/of wachtwoord is onjuist.');

            echo $form;
        }
    }else{
        echo $form;
    }

