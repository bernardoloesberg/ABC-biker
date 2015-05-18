/**
*@Author: Tom Kooiman
*/
use abcbiker;

DROP procedure IF exists sp_CreateCustomer;

DELIMITER //
CREATE PROCEDURE sp_CreateCustomer
  (customerlastname VARCHAR(40), customerfirstname VARCHAR(40), phonenumber DECIMAL(14,0), sex CHAR(1), companyname VARCHAR(40), contactlastname VARCHAR(40), contactfirstname VARCHAR(40), email VARCHAR(50))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
/* Email validation businessRule on Customer insert
    IF (email REGEXP '')
    THEN
      RESIGNAL SQLSTATE '45001'
      SET MESSAGE_TEXT = 'Geen geldig emailadres!';
    ROLLBACK;
/* Name businessRule  if special characters are used */
    /*ELSE*/IF (customerlastname REGEXP '[^a-zA-ZÀ-ÖØ-ʯ ]' || customerfirstname REGEXP '[^a-zA-ZÀ-ÖØ-ʯ ]')
    THEN
     SIGNAL SQLSTATE '45002'
     SET MESSAGE_TEXT = 'De naam van de klant bevat niet toegestane tekens!';
  ROLLBACK;
/*sex businessRule can only be m or v */
    ELSEIF (sex REGEXP '[^mvMV]')
      THEN
        SIGNAL SQLSTATE '45003'
        SET MESSAGE_TEXT = 'Geen geldig geslacht!';
    ROLLBACK;
    /*Name businessRule  if special characters are used*/
    ELSEIF (contactlastname REGEXP '[^a-zA-ZÀ-ÖØ-ʯ ]' || contactfirstname REGEXP '[^a-zA-ZÀ-ÖØ-ʯ ]')
      THEN
        SIGNAL SQLSTATE '45003'
        SET MESSAGE_TEXT = 'De naam van de contactpersoon bevat niet toegestane tekens!';
    ROLLBACK;
    ELSE
      INSERT INTO customer (customerlastname, customerfirstname, phonenumber, sex, companyname, contactlastname, contactfirstname, email)
      VALUES (customerlastname, customerfirstname, phonenumber, sex, companyname, contactlastname, contactfirstname, email);
      COMMIT;
    END IF;
  END //
DELIMITER ;

/* EXECUTE */

SET @p0='Kooiman'; SET @p1='Tom'; SET @p2='123456789'; SET @p3='k'; SET @p4='Cageman inc.'; SET @p5='Kooiman'; SET @p6='Tom'; SET @p7='tom@kooiman.com'; CALL `sp_CreateCustomer`(@p0, @p1, @p2, @p3, @p4, @p5, @p6, @p7);
