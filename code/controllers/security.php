<?php
    /**
     * @author: Bernardo Loesberg
     */
    if(isset($_SESSION['user'])){
        $inactive_time = 1200; // 20 minutes

        if(isset($_SESSION['ip']) && $_SESSION['ip'] != $_SERVER['REMOTE_ADDR']) {
            session_destroy();
        }

        if(isset($_SESSION['current_time'])) //Inactive
        {
            $session_life_time = time() - $_SESSION['current_time'];

            if($session_life_time > $inactive_time){
                header('Location: index.php');
                session_destroy();
            }
        }

        $_SESSION['current_time'] = time();
    }
