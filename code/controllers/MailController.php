<?php
    /**
     * Class MailController
     * @Author: Tom Kooiman
     */
    class MailController{
        /**
         * When instance has been created then the class get the connection.
         */
        function __construct(){
            $server = new ConnectionController();
            $this->connection = $server->getConnection();
            unset($server);
        }

        function sendPasswordForNewCostumer($customernumber, $pw) {
            $queryEmail = 'SELECT email FROM customer WHERE customernumber = '.$customernumber['customernumber'];

            if($result = $this->connection->query($queryEmail)){
                if($result) {
                    if($this->connection->affected_rows < 1) {
                        return 'er is geen klant met dit klantnummer';
                    }
                    $email = $result->fetch_array();


                    $subject = 'Welkom bij ABCBiker : Uw inlogegevens';
                    $contents = '
                    Beste Klant,

                    Welkom bij ABCbiker
                    Hierbij sturen we je de inlogegevens voor de website.
                    Uw inlognaam is: '.$email['email'].'
                    Uw wachtwoord is: '.$pw.'

                    Wij hopen hiermee u genoeg geinformeerd te hebben.

                    ABCBiker Team
                    ';
                    echo $email['email'] .' '. $subject .' '. $contents .' ';
                    if(mail($email['email'],$subject,$contents)) {
                        echo 'mail sent';
                    } else {
                        echo 'no mail sent';
                    }
                }
            }
            return $this->connection->error;





        }

        function getConnection(){
            return $this->connection;
        }
    }