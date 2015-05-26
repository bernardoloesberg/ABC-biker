/**
*@Author: Tom Kooiman
*/
use abcbiker;

DROP procedure IF exists sp_AddAddressToCustomer;

DELIMITER //
CREATE PROCEDURE sp_AddAddressToCustomer
  (IN addressnumber INT, IN customernumber INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      INSERT INTO AddressForCustomer
          VALUES (addressnumber, customernumber);
    COMMIT;
  END //
DELIMITER ;

/* EXECUTE */