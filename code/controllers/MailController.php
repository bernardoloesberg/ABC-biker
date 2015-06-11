<?php
    require_once('lib/PHPMailer/PHPMailerAutoload.php');
    /**
     * Class MailController
     * @Author: Tom Kooiman
     */
    class MailController{
            private $mail;
        /**
         * When instance has been created then the class get the connection.
         */
        function __construct(){
            $server = new ConnectionController();
            $this->connection = $server->getConnection();
            unset($server);

            /**
             * To start the PHPmailer
             */
            $this->mail = new PHPMailer();

            $this->mail->SMTPDebug = 3;

            $this->mail->isSMTP();
            $this->mail->Host = 'smtp.mail.com';
            $this->mail->SMTPAuth = true;
            $this->mail->Username = 'ABCBiker@mail.com';
            $this->mail->Password = 'Hallo!23';
            $this->mail->SMTPSecure = 'tls';
            $this->mail->Port = '587';

            $this->mail->From = 'ABCBiker@mail.com';
            $this->mail->FromName = 'ABCBiker';

        }

        function sendPasswordForNewCostumer($customernumber, $pw) {
            $queryEmail = 'SELECT customerlastname, customerfirstname, email FROM customer WHERE customernumber = '.$customernumber['customernumber'];

            if($result = $this->connection->query($queryEmail)){
                if($result) {
                    if($this->connection->affected_rows < 1) {
                        return 'er is geen klant met dit klantnummer';
                    }
                    $customer = $result->fetch_array();

                    $this->mail->addAddress($customer['email']);

                    $this->mail->Subject = 'Welkom bij ABCBiker : Uw inlogegevens';
                    $this->mail->Body = 'Beste '.$customer['customerfirstname'].' '.$customer['customerlastname'].',

                    Welkom bij ABCbiker.
                    Hierbij sturen we je de inlogegevens voor de website.
                    Uw inlognaam is: '.$customer['email'].'
                    Uw wachtwoord is: '.$pw.'

                    Wij hopen hiermee u voldoende geinformeerd te hebben.

                    ABCBiker Team';


                    if($this->mail->send()) {
                        return 'success';
                    } else {
                        return 'De mail kon niet verstuurd worden '.'Mailer Error: ' . $this->mail->ErrorInfo;
                    }
                }
            }
            return $this->connection->error;
        }

        function getConnection(){
            return $this->connection;
        }
    }