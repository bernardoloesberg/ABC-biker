DROP procedure IF exists sp_ChangeCustomer;

DELIMITER //
CREATE PROCEDURE sp_ChangeCustomer(IN customer INT, IN lastname VARCHAR(40),IN firstname VARCHAR(40),IN phone DECIMAL(14,0),IN sexin CHAR(1),IN company VARCHAR(40),IN emailaddress VARCHAR(50))
BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

/* Email validation businessRule on Customer insert */
  IF (emailaddress NOT REGEXP '^[0-9_a-z-]+(\\.[0-9_a-z-]+)*@([0-9a-z-]+\\.)+[a-z]{2,6}$')
  THEN
    SIGNAL SQLSTATE '45100'
    SET MESSAGE_TEXT = 'Geen geldig emailadres!';
  ROLLBACK;
/* Name businessRule  if special characters are used */
 ELSEIF (lastname REGEXP '[^a-zA-Z ]' || firstname REGEXP '[^a-zA-Z ]')
  THEN
    SIGNAL SQLSTATE '45101'
    SET MESSAGE_TEXT = 'De naam mag alleen uit letters bestaan';
    ROLLBACK;
/*sex businessRule can only be m or v */
  ELSEIF (sexin REGEXP '[^mv]')
    THEN
      SIGNAL SQLSTATE '45102'
      SET MESSAGE_TEXT = 'Geen geldig geslacht!';
      ROLLBACK;
/*Phonenumber can only exists out of numbers*/
  ELSEIF (phone REGEXP '[^0-9]')
    THEN
      SIGNAL SQLSTATE '45103'
      SET MESSAGE_TEXT = 'Geen geldig Telefoonummner!';
      ROLLBACK;
      ELSE
    UPDATE customer
      SET customerlastname = lastname, customerlastname = lastname, phonenumber = phone, sex = sexin, companyname = company, email = emailaddress
      WHERE customernumber = customer;
      COMMIT;
    END IF;
  END //
DELIMITER ;