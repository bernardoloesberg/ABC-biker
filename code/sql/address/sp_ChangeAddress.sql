/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_ChangeAddress;

DELIMITER //
CREATE PROCEDURE sp_ChangeAddress(
  IN p_districtname varchar(40),
  IN p_street varchar(40),
  IN p_zipcode varchar(6),
  IN p_housenumber int,
  IN p_city varchar(40),
  IN p_housenumberaddon char(1)
)
  BEGIN
    DECLARE p_districtnumber int;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;

    IF (p_street NOT REGEXP '[a-zA-Z ]')
    THEN
      SIGNAL SQLSTATE '45008'
      SET MESSAGE_TEXT = 'De straat mag alleen letters bevatten!';
      ROLLBACK ;
    ELSEIF (p_zipcode NOT REGEXP '^[1-9][0-9]{3}\s?[a-zA-Z]{2}$')
    THEN
      SIGNAL SQLSTATE '45010'
      SET MESSAGE_TEXT = 'Geen geldig postcode!';
      ROLLBACK ;
    ELSEIF (p_housenumber NOT REGEXP '[0-9]')
    THEN
      SIGNAL SQLSTATE '45011'
      SET MESSAGE_TEXT = 'Huisnummer mag alleen uit cijfers bestaan! Een toevoeging voor het huisnummer mag in het toevoegingsveld!';
      ROLLBACK ;
    ELSEIF (p_city NOT REGEXP '[a-zA-Z ]')
    THEN
      SIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'De woonplaats mag alleen letters bevatten!';
      ROLLBACK ;

      ELSE
    START TRANSACTION;
    SET p_districtnumber = (SELECT districtnumber FROM district WHERE districtname = p_districtname);
    CALL sp_GetAddressNumber(p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon, @p_addressnumber);
    UPDATE address SET districtnumber = p_districtnumber, street = p_street, city = p_city WHERE addressnumber = @p_addressnumber;
    COMMIT;
      END IF;
  END //
DELIMITER ;