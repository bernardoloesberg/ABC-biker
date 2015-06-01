/*
 *@Author: Tom Kooiman
 */
use abcbiker;

DROP procedure IF exists sp_DeleteCustomerAddress;

DELIMITER //
CREATE PROCEDURE  sp_DeleteCustomerAddress (IN customer  INT, IN address INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    DELETE FROM addressforcustomer WHERE customernumber = customer AND addressnumber  = address;
    COMMIT;
  END //
DELIMITER ;