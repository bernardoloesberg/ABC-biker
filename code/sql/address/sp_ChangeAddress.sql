/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_ChangeAddress;

DELIMITER //
CREATE PROCEDURE sp_ChangeAddress(
  IN p_districtnumber int,
  IN p_street varchar(40),
  IN p_zipcode varchar(6),
  IN p_housenumber int,
  IN p_city varchar(40),
  IN p_housenumberaddon char(1)
)
  BEGIN
    DECLARE p_addressnumber int;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    CALL sp_GetAddressNumber(p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon, @p_addressnumber);
    UPDATE address SET districtnumber = p_districtnumber, street = p_street, city = p_city WHERE addressnumber = @p_addressnumber;
    COMMIT;
  END //
DELIMITER