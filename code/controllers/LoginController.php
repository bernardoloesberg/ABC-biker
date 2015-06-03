<?php
    include_once('ConnectionController.php');

    /**
     * Class LoginController
     * @author: Bernardo Loesberg
     */
    class LoginController{
        private $server;

        /**
         * When instance has been created then the class get the connection.
         */
        function __construct(){
            $server = new ConnectionController();
            $this->server = $server->getConnection();
            unset($server);
        }

        function authentication($user){
            $query = 'SELECT * FROM vw_authenticateUser WHERE email = '. mysqli_real_escape_string($this->connection,$user['email']) . 'AND password = '.mysqli_real_escape_string($this->connection,$this->hashPassword($user['password']));

            $account = array();

            if($result = $this->connection->query($query)){
                $account = $result->fetch_assoc();
            }

            return $account;
        }

        function hashPassword($password){
            if(!empty($password)){
                $password = trim($password);
                $password = hash('sha256', $password . $this->salt);

                return $password;
            }else{
                return array('style' => 'danger', 'message' => 'U heeft geen !');
            }
        }

        function googleAuthentication(){

        }

        /**
         * When the class isn't used anymore the connection will be closed.
         */
        function __destruct(){
            $this->server->close();
        }
    }