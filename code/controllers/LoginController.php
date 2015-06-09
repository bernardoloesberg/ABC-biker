<?php
    include_once('ConnectionController.php');

    /**
     * Class LoginController
     * @author: Bernardo Loesberg
     */
    class LoginController{
        private $connection;

        /**
         * When instance has been created then the class get the connection.
         */
        function __construct(){
            $server = new ConnectionController();
            $this->connection = $server->getConnection();
            unset($server);
        }

        /**
         * Authenticate user.
         * @param $user
         * @return array
         */
        function authentication($user){
            $query = "SELECT * FROM vw_authenticateUser WHERE email = '". mysqli_real_escape_string($this->connection,$user['email']) . "' AND password = '".mysqli_real_escape_string($this->connection,$this->hashPassword($user['password'])) . "'";
            $account = array();

            if($result = $this->connection->query($query)){
                $account = $result->fetch_assoc();
            }

            return $account;
        }

        /**
         * Hash password with Sha1.
         * @param $password
         * @return null|string
         */
        function hashPassword($password){
            if(!empty($password)){
                $password = trim($password);
                $password = hash('sha256', $password);

                return $password;
            }else{
                return null;
            }
        }

        function googleAuthentication(){

        }

        function passwordGenerator($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        /**
         * When the class isn't used anymore the connection will be closed.
         */
        function __destruct(){
            $this->connection->close();
        }
    }