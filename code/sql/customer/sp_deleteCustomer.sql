/*
 *@Author: Tom Kooiman
 */
use abcbiker;

CREATE PROCEDURE  sp_deleteCustomer (IN id  INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    DELETE FROM customer WHERE customernumber = id;
    COMMIT;
  END