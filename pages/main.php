<?php
function getMenu(){
    $biker = '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zending <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/account">Mijn opdrachten</a></li>
                    </ul>
              </li>';


    $manager = '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zending <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/consignmentoverview">Zending overzicht</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Werknemer <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/employeeoverview">Werknemer overzicht</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Klant <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/customeroverview">klant overzicht</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Adres <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/addressoverview">Adres overzicht</a></li>
                    </ul>
                </li>';

    $dispatcher = '<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Zending <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/consignmentoverview">Zending overzicht</a></li>
                        <li><a href="'.$_SESSION['rooturl'].'/consignmentcreate">Zending aammaken</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Werknemer <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/employeeoverview">Werknemer overzicht</a></li>
                        <li><a href="'.$_SESSION['rooturl'].'/employeecreate">Werknemer aanmaken</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Klant <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/customeroverview">klant overzicht</a></li>
                        <li><a href="'.$_SESSION['rooturl'].'/customercreate">klant aanmaken</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Adres <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="'.$_SESSION['rooturl'].'/addressoverview">Adres overzicht</a></li>
                    </ul>
                </li>';


    echo '<nav class="navbar navbar-default" role="navigation">
                  <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="'.$_SESSION['rooturl'].'">ABC-Bikers</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">

                        '.(isset($_SESSION['user']) && !empty($_SESSION['user']['rolename']) && $_SESSION['user']['rolename'] == 'biker' ? $biker : '').'
                        '.(isset($_SESSION['user']) && !empty($_SESSION['user']['rolename']) && $_SESSION['user']['rolename'] == 'manager' ? $manager : '').'
                        '.(isset($_SESSION['user']) && !empty($_SESSION['user']['rolename']) && $_SESSION['user']['rolename'] == 'dispatcher' ? $dispatcher : '').'

                      </ul>

                      <ul class="nav navbar-nav navbar-right">
                        '.(empty($_SESSION['user']['employeenumber'])  ? '<li><a href="'.$_SESSION['rooturl'].'/customercreate">Registreren</a></li>
                                                                                                      <li><a href="'.$_SESSION['rooturl'].'/login">Inloggen</a></li>'
                                                                                                   : '<li class="dropdown">
                                                                                                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                                                                                                          <ul class="dropdown-menu">
                                                                                                            <li><a href="'.$_SESSION['rooturl'].'/account">Mijn profiel</a></li>
                                                                                                            <li class="divider"></li>
                                                                                                            <li><a href="#">Uitloggen</a></li>
                                                                                                          </ul>
                                                                                                        </li>').'
                      </ul>
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
              </nav>';
}

function getContent(){
    if(isset($_GET['page'])){
        if(file_exists('pages/page/'.$_GET['page'].'.php')){
            include_once 'page/'.$_GET['page'].'.php';
        }
        else{
            include_once 'page/404.php';
        }
    }else{
        include_once 'page/home.php';
    }
}

function getFooter(){
    // TODO: Create footer
}