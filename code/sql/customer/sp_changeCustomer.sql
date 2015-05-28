CREATE PROCEDURE sp_changeCustomer(IN customer INT, IN lastname VARCHAR(40),IN firstname VARCHAR(40),IN phone DECIMAL(14,0),IN sexin CHAR(1),IN company VARCHAR(40),IN emailaddress VARCHAR(50))
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
/*ELSE*/IF (customerlastname REGEXP '[^a-zA-Z ]' || customerfirstname REGEXP '[^a-zA-Z ]')
  THEN
    SIGNAL SQLSTATE '45002'
    SET MESSAGE_TEXT = 'De naam mag alleen uit letters bestaan';
    ROLLBACK;
/*sex businessRule can only be m or v */
  ELSEIF (sex REGEXP '[^mv]')
    THEN
      SIGNAL SQLSTATE '45003'
      SET MESSAGE_TEXT = 'Geen geldig geslacht!';
      ROLLBACK;
/*Phonenumber can only exists out of numbers*/
  ELSEIF (phonenumber REGEXP '[^0-9]')
    THEN
      SIGNAL SQLSTATE '45004'
      SET MESSAGE_TEXT = 'Geen geldig Telefoonummner!';
      ROLLBACK;
      ELSE
    UPDATE customer
      SET customerlastname = lastname, customerlastname = lastname, phonenumber = phone, sex = sexin, companyname = company, email = emailaddress
      WHERE customernumber = customer;
      COMMIT;
    END IF;
  END