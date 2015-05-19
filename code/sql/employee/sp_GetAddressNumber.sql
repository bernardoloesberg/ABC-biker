/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

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
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF (Select * FROM address WHERE zipcode = p_zipcode AND housenumber = p_housenumber AND housenumberaddon = p_housenumberaddon) = NULL THEN
      INSERT INTO Address(districtnumber, street, zipcode, housenumber, city, housenumberaddon)
      VALUES (p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);
      END IF;
      SET p_addressnumber = Select addressnumber FROM address WHERE (zipcode = p_zipcode AND housenumber = p_housenumber AND housenumberaddon = p_housenumberaddon) LIMIT 1;
    COMMIT;
  END //
DELIMITER ;