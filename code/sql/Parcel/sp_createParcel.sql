/*
 * Author: Bernardo Loesberg
 */
DROP procedure IF exists sp_createParcel;

DELIMITER //
CREATE PROCEDURE sp_createParcel
  (IN p_consignmentnumber     INT,
   IN p_pickupemployeenumber  INT,
   IN p_deliveremployeenumber INT,
   IN p_street                VARCHAR(40),
   IN p_zipcode               VARCHAR(6),
   IN p_housenumber           INT,
   IN p_city                  VARCHAR(40),
   IN p_housenumberaddon      CHAR(1),
   IN p_weightingrams         INT,
   IN p_pickup                DATETIME,
   IN p_deliver               DATETIME,
   IN p_hqarrival             DATETIME,
   IN p_hqdeparmenture        DATETIME,
   IN p_comment               TEXT)
  BEGIN
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
      IF EXISTS(SELECT 1 FROM address WHERE addressnumber = p_addressnumber)
      THEN
        CALL sp_CreateAddress
        (1,p_street,p_housenumber,p_zipcode,p_city,p_housenumberaddon);
      END IF;
    COMMIT;
  END //
DELIMITER ;

CALL sp_ChangeConsignment
(2,1,'Eeshofstraat', '6825BV', 2, 'Arnhem', '','Zilverakkerweg', '6952DX', 59, 'Arnhem','', 1, 'Tom Kooiman')
