<?php
    function getMenu(){
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
                      <a class="navbar-brand" href="#">Clean site start</a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                      <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="'.$_SESSION['rooturl'].'/consignmentoverview">Consignment lijst</a></li>
                        <li><a href="'.$_SESSION['rooturl'].'/consignmentcreate">Consignment toevoegen</a></li>
                      </ul>

                      <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Registreren</a></li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                          <ul class="dropdown-menu">
                            <li><a href="#">Mijn profiel</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Uitloggen</a></li>
                          </ul>
                        </li>
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