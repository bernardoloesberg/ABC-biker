/*
 *@Author: Bernardo Loesberg
 */
use `abcbiker`;

DROP procedure IF exists sp_createConsignment;

CALL sp_createConsignment
(1,'Eeshofstraat','6825BV','2','Arnhem','','Bernardo Loesberg', 1, NOW(),NOW(),100,90, @p_consignmentnumber);

DELIMITER //
CREATE PROCEDURE sp_createConsignment
  (IN p_customernumber       INT,
    IN p_pickupstreet        VARCHAR(40),
    IN p_pickupzipcode       VARCHAR(6),
    IN p_pickuphousenumber   INT,
    IN p_pickupcity          VARCHAR(40),
    IN p_pickuphousenumberaddon char(1),
    IN p_consignorname       VARCHAR(40),
    IN p_completed           BOOLEAN,
    IN p_scheduledpickup     DATETIME,
    IN p_scheduleddelivery   DATETIME,
    IN p_price               FLOAT(6,2),
    IN p_totalprice          FLOAT(6,2),
    OUT p_consignmentnumber      INT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    /*Check if the customer exists*/
    IF NOT EXISTS(SELECT 1 FROM customer WHERE customernumber = p_customernumber)
    THEN
      RESIGNAL SQLSTATE '45012'
      SET MESSAGE_TEXT = 'Er bestaat geen klant met de opgegeven nummer';
      ROLLBACK;
    END IF;
    /*Check if there is a pickup addres*/
    IF NOT EXISTS(SELECT 1 FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumber AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon)
    THEN
      CALL sp_createAddress
      (1, p_pickupstreet, p_pickupzipcode, p_pickuphousenumber, p_pickupcity, p_pickuphousenumberaddon);
    END IF;

    INSERT INTO consignment
    (customernumber,addressnumber,consignorname,completed,scheduledpickup,scheduleddelivery,price,totalprice)
    VALUES
    (p_customernumber,(SELECT addressnumber FROM address WHERE street = p_pickupstreet AND zipcode = p_pickupzipcode AND housenumber = p_pickuphousenumber AND city = p_pickupcity AND housenumberaddon = p_pickuphousenumberaddon),p_consignorname,p_completed,p_scheduledpickup,p_scheduleddelivery,p_price,p_totalprice);

    SET p_consignmentnumber = LAST_INSERT_ID();
    COMMIT;
  END //
DELIMITER ;



