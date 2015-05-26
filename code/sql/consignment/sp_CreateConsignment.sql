/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists sp_CreateConsignment;

DELIMITER //
CREATE PROCEDURE sp_CreateConsignment
  (IN p_customernumber       INT,
   IN p_deliverstreet       VARCHAR(40),
   IN p_deliverzipcode      VARCHAR(6),
   IN p_deliverhousenumber  INT,
   IN p_delivercity         VARCHAR(40),
   IN p_deliverhousenumberaddon char(1),
   IN p_pickupstreet        VARCHAR(40),
   IN p_pickupzipcode       VARCHAR(6),
   IN p_pickuphousenumber   INT,
   IN p_pickupcity          VARCHAR(40),
   IN p_pickuphousenumberaddon char(1),
   IN p_consignorname       VARCHAR(40))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    IF NOT EXISTS(SELECT 1 FROM customer WHERE customernumber = p_customernumber)
    THEN
      RESIGNAL SQLSTATE '45012';
/*SET MESSAGE_TEXT = 'Er bestaat geen klant met de opgegeven nummer';*/
      ROLLBACK;
    END IF;

    IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_deliverstreet AND zipcode = p_deliverzipcode AND housenumber = p_deliverhousenumber AND city = p_delivercity AND housenumberaddon = p_deliverhousenumberaddon)
    THEN
      CALL sp_createAddress
      (0, p_deliverstreet, p_deliverzipcode, p_deliverhousenumber, p_delivercity, p_deliverhousenumberaddon);
    END IF;

    IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumber AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon)
    THEN
      CALL sp_createAddress
      (0, p_pickupstreet, p_pickupzipcode, p_pickuphousenumber, p_pickupcity, p_pickuphousenumberaddon);
    END IF;

    INSERT INTO consignment
    (customernumber,pickupaddressnumber,deliveraddressnumber,consignorname)
    VALUES
      (p_customernumber, (SELECT addressnumber FROM address WHERE street = p_deliverstreet AND zipcode = p_deliverzipcode AND housenumber = p_deliverhousenumber AND city = p_delivercity AND housenumberaddon = p_deliverhousenumberaddon),(SELECT addressnumber FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumber AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon), p_consignorname);
    COMMIT;
  END //
DELIMITER ;

CALL sp_CreateConsignment
(1,'Eeshofstraat','6825BV','2','Arnhem','','Goudensteinstraat','6825CS','32','Arnhem','','Bernardo Loesberg');
