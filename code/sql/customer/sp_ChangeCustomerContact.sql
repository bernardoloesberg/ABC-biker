/**
*@Author: Tom Kooiman
*/
use abcbiker;

DROP procedure IF exists sp_ChangeCustomerContact;

DELIMITER //
CREATE PROCEDURE sp_ChangeCustomerContact
  (IN contact INT, IN lastname VARCHAR(40), IN firstname VARCHAR(40),IN sexin CHAR(1), IN phone VARCHAR(14), IN email VARCHAR(50), IN department VARCHAR(40))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
/* Name businessRule  if special characters are used */
    IF (lastname REGEXP '[^a-zA-Z ]' || firstname REGEXP '[^a-zA-Z ]')
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
      UPDATE customercontact
      SET contactlastname = lastname, contactfirstname = firstname, contactsex = sexin, contactphonenumber = phone, contactemail = email, contactdepartment = department
      WHERE contactnumber = contact;
      COMMIT;
    END IF;

  END //
DELIMITER ;

/* EXECUTE */

