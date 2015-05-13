/*
 *@Author: Bernardo Loesberg
 */
use `database`;

DROP procedure IF exists sp_CreateConsignment;

DELIMITER //
CREATE PROCEDURE sp_CreateConsignment
  (IN p_customernumber       INT,
    IN p_deliverstreet       VARCHAR(40),
    IN p_deliverhousenumber  INT,
    IN p_deliverzipcode      VARCHAR(6),
    IN p_delivercity         VARCHAR(40),
    IN p_deliverhousenumberaddon char(1),
    IN p_pickupstreet        VARCHAR(40),
    IN p_pickuphousenumber   INT,
    IN p_pickupzipcode       VARCHAR(6),
    IN p_pickupcity         VARCHAR(40),
    IN p_pickuphousenumberaddon char(1),
    IN p_consignorname       VARCHAR(40))
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF NOT EXISTS (SELECT 1 FROM address
                      WHERE street = p_deliverstreet
                      AND zipcode = p_deliverzipcode
                      AND housenumber = p_deliverhousenumber)
        BEGIN
        END
    COMMIT;
  END //
DELIMITER ;