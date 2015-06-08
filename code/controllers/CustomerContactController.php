<?php

include_once('ConnectionController.php');
/**
 * Created by PhpStorm.
 * User: Tom Kooiman
 * Date: 6/1/2015
 * Time: 10:04 AM
 */

class CustomerContactController {
    private $connection;

    /**
     * When instance has been created then the class get the connection.
     */
    function __construct(){
        $server = new ConnectionController();
        $this->connection = $server->getConnection();
        unset($server);
    }

    function getContact($id) {
        $query = "SELECT * FROM vw_CustomerContactList WHERE contactnumber = ".$id;

        if($result = $this->connection->query($query)) {
            return $result->fetch_array();
        }
    }

    function addContactToCustomer($contact) {
        $query = "CALL sp_CreateCustomerContact('" . mysqli_real_escape_string($this->connection, $contact['customernumber']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactlastname']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactfirstname']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactsex']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactphonenumber']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactemail']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactdepartment']) . "'" .")";
        echo $query;

        if ($result = $this->connection->query($query)) {
            if($result) {
                return 'success';
            }
        }
        return $this->connection->error;
    }

    function changeContact ($contact) {
        $query = "CALL sp_ChangeCustomerContact('" . mysqli_real_escape_string($this->connection, $contact['contactnumber']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactlastname']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactfirstname']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactsex']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactphonenumber']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactemail']) . "',
                                                '" . mysqli_real_escape_string($this->connection, $contact['contactdepartment']) . "')";

        if ($result = $this->connection->query($query)) {
            if($result) {
                return 'success';
            }
        }
        return $this->connection->error;
    }

    function getCustomerContactList ($customer) {
        $query = "SELECT * FROM vw_CustomerContactList WHERE customernumber = ".$customer;
        $contactList = array();

        if($result = $this->connection->query($query)){
            foreach($result as $contact){
                $contactList[] = $contact;
            }
        }
        return $contactList;
    }

    function deleteCustomerContact ($contact) {
        $query = "CALL sp_DeleteCustomerContact(".mysqli_real_escape_string($this->connection, $contact['contactnumber']).")";
        print $query;

        if($result = $this->connection->query($query)) {
            if($result) {
                return 'success';
            }
        }

        return $this->connection->error;
    }

    function __destruct(){
        $this->connection->close();
    }
}