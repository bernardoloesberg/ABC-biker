/*
 *@Author: Bernardo Loesberg
 */
use 'abcbiker';

DROP procedure IF exists sp_GetAddressNumber;

DELIMITER //
CREATE PROCEDURE sp_GetAddressNumber(
  IN p_districtnumber int,
  IN p_street varchar(40),
  IN p_zipcode varchar(6),
  IN p_housenumber int,
  IN p_city varchar(40),
  IN p_housenumberaddon char(1),
  OUT p_addressnumber int
)
  BEGIN
    IF Select * FROM Address WHERE p_zipcode = zipcode AND p_housenumber = housenumber AND p_housenumberaddon = housenumberaddon = null THEN
    INSERT INTO Address(districtnumber, street, zipcode, housenumber, city, housenumberaddon)
    VALUES (p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);
    END IF;
    SET p_addressnumber = Select addressnumber FROM Address WHERE p_zipcode = zipcode AND p_housenumber = housenumber AND p_housenumberaddon = housenumberaddon;

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    COMMIT;
  END //
DELIMITER ;