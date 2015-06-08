/**
*@Author: Tom Kooiman
*/
use abcbiker;

DROP procedure IF exists sp_CreateCustomer;

DELIMITER //
CREATE PROCEDURE sp_CreateCustomer
  (IN lastname VARCHAR(40),IN firstname VARCHAR(40),IN phone DECIMAL(14,0),IN sexin CHAR(1),IN company VARCHAR(40),IN emailaddress VARCHAR(50))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    IF EXISTS (SELECT '' FROM customer WHERE customerlastname = lastname AND customerfirstname = firstname AND phonenumber = phone AND companyname = company AND email = emailaddress)
      THEN
        SIGNAL SQLSTATE '45034'
          SET MESSAGE_TEXT = 'Klant bestaat al!';
        ROLLBACK;

/* Email validation businessRule on Customer insert */
    ELSEIF (emailaddress NOT REGEXP '^[0-9_a-z-]+(\\.[0-9_a-z-]+)*@([0-9a-z-]+\\.)+[a-z]{2,6}$')
    THEN
      SIGNAL SQLSTATE '45100'
      SET MESSAGE_TEXT = 'Geen geldig emailadres!';
      ROLLBACK;

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

      INSERT INTO customer (customerlastname, customerfirstname, phonenumber, sex, companyname,email)
      VALUES (lastname, firstname, phone, sexin, company, emailaddress);
      COMMIT;
    END IF;

  END //
DELIMITER ;

/* EXECUTE */

