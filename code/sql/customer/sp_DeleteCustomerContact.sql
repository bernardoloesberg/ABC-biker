/*
 *@Author: Tom Kooiman
 */
use abcbiker;

DROP procedure IF exists sp_DeleteCustomerContact;

DELIMITER //
CREATE PROCEDURE  sp_DeleteCustomerContact (IN contact INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    DELETE FROM customercontact WHERE contactnumber = contact;
    COMMIT;
  END //
DELIMITER ;