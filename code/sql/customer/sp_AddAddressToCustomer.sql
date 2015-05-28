/**
*@Author: Tom Kooiman
*/
use abcbiker;

DROP procedure IF exists sp_AddAddressToCustomer;

DELIMITER //
CREATE PROCEDURE sp_AddAddressToCustomer
  (IN address INT, IN customer INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    IF NOT EXISTS(SELECT '' FROM address WHERE addressnumber = address)
      THEN
      RESIGNAL SQLSTATE '45005'
        SET MESSAGE_TEXT = 'Adres bestaat niet!';
        ROLLBACK ;
    ELSEIF NOT EXISTS (SELECT '' FROM address WHERE customernumber = customer)
      THEN
      RESIGNAL SQLSTATE '45006'
        SET MESSAGE_TEXT = 'klant bestaat niet!';
      ROLLBACK ;
    ELSE
      INSERT INTO AddressForCustomer
          VALUES (addressnumber, customernumber);
      COMMIT;
  END IF;
  END //
DELIMITER ;

/* EXECUTE */