/*
 *@Author: Christiaan ten Voorde
 */
use 'abcbiker';

DROP procedure IF exists sp_CreateEmployee;

DELIMITER //
CREATE PROCEDURE sp_CreateEmployee(
  IN p_districtnumber int,
  IN p_street varchar(40),
  IN p_zipcode varchar(6),
  IN p_housenumber int,
  IN p_city varchar(40),
  IN p_housenumberaddon char(1),
  IN p_employeelastname varchar(40),
  IN p_employeefirstname varchar(40),
  IN p_bsn int,
  IN p_cellphone numeric(14,0),
  IN p_birthday date,
  IN p_sex char(1),
)
  BEGIN
    DECLARE p_addressnumber int;
    SET p_addressnumber = sp_GetAddressNumber(p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon);
    INSERT INTO Employee(addressnumber, employeelastname, employeefirstname, bsn, cellphone, birthday, sex)
    VALUES (p_addressnumber, p_employeelastname, p_employeefirstname, p_bsn, p_cellphone, p_birthday, p_sex)

    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;

    COMMIT;
  END //
DELIMITER ;
