/*
 *@Author: Christiaan ten Voorde
 */
use `abcbiker`;

DROP procedure IF exists sp_ChangeEmployee;

DELIMITER //
CREATE PROCEDURE sp_ChangeEmployee(
  IN p_employeenumber int,
  IN p_districtnumber int,
  IN p_street varchar(40),
  IN p_zipcode varchar(6),
  IN p_housenumber int,
  IN p_city varchar(40),
  IN p_housenumberaddon char(1),
  IN p_employeefirstname varchar(40),
  IN p_employeelastname varchar(40),
  IN p_bsn int,
  IN p_cellphone numeric(14,0),
  IN p_birthday date,
  IN p_sex char(1)
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
	  SET p_addressnumber = @p_addressnumber;
	  UPDATE Employee SET addressnumber=p_addressnumber,
	                      employeelastname = p_employeelastname,
	                      employeefirstname=p_employeefirstname,
	                      bsn = p_bsn,
	                      cellphone = p_cellphone,
	                      birthday = p_birthday,
	                      sex = p_sex
                    WHERE employeenumber = p_employeenumber;
    COMMIT;
  END //
DELIMITER ;