/**
*@Author: Tom Kooiman
*/
use abcbiker;

DROP procedure IF exists sp_CreateCustomerContact;

DELIMITER //
CREATE PROCEDURE sp_CreateCustomerContact
  (IN customer INT, IN lastname VARCHAR(40), IN firstname VARCHAR(40),IN sexin CHAR(1), IN phone VARCHAR(14), IN email VARCHAR(50), IN department VARCHAR(40))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
/* Email validation businessRule on CustomerContact insert */
   IF (email NOT REGEXP '^[0-9_a-z-]+(\\.[0-9_a-z-]+)*@([0-9a-z-]+\\.)+[a-z]{2,6}$')
    THEN
    SIGNAL SQLSTATE '45100'
    SET MESSAGE_TEXT = 'Geen geldig emailadres!';
  ROLLBACK;
/* Customer must exists*/
    ELSEIF NOT EXISTS (SELECT '' FROM customer WHERE customernumber = customer)
      THEN
      SIGNAL SQLSTATE '45025'
        SET MESSAGE_TEXT = 'De klant bestaat niet!';
      ROLLBACK ;
/* Name businessRule  if special characters are used */
    ELSEIF (lastname REGEXP '[^a-zA-Z ]' || firstname REGEXP '[^a-zA-Z ]')
    THEN
     SIGNAL SQLSTATE '45002'
     SET MESSAGE_TEXT = 'De naam mag alleen uit letters bestaan';
  ROLLBACK;
/*sex businessRule can only be m or v */
    ELSEIF (sexin REGEXP '[^mv]')
      THEN
        SIGNAL SQLSTATE '45003'
        SET MESSAGE_TEXT = 'Geen geldig geslacht!';
    ROLLBACK;
/*Phonenumber can only exists out of numbers*/
    ELSEIF (phone REGEXP '[^0-9]')
      THEN
        SIGNAL SQLSTATE '45004'
          SET MESSAGE_TEXT = 'Geen geldig Telefoonummner!';
    ROLLBACK;
    ELSE
      INSERT INTO customercontact (customernumber, contactlastname, contactfirstname, contactsex, contactphonenumber,contactemail, contactdepartment)
      VALUES (customer, lastname, firstname, sexin, phone, email, department);
      COMMIT;
    END IF;

  END //
DELIMITER ;

/* EXECUTE */

