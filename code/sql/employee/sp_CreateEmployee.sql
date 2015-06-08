/*
 *@Author: Christiaan ten Voorde
 */
use abcbiker;

DROP procedure IF exists sp_CreateEmployee;

DELIMITER //
CREATE PROCEDURE sp_CreateEmployee(
  IN p_districtnumber int,
  IN p_street varchar(40),
  IN p_zipcode varchar(6),
  IN p_housenumber int,
  IN p_city varchar(40),
  IN p_housenumberaddon char(1),
  IN p_employeefirstname varchar(40),
  IN p_employeelastname varchar(40),
  IN p_bsn varchar(9),
  IN p_cellphone varchar(14),
  IN p_birthday date,
  IN p_sex char(1),
  IN p_password varchar(24)
)
  BEGIN
    DECLARE p_addressnumber int;
    DECLARE EXIT HANDLER FOR SQLEXCEPTION
    BEGIN
      RESIGNAL SQLSTATE '45000';
      ROLLBACK;
    END;
    START TRANSACTION;
    /* Name businessRule  if special characters are used */
    IF (p_street REGEXP '[^a-zA-Z ]')
    THEN
     SIGNAL SQLSTATE '45101'
     SET MESSAGE_TEXT = 'De straatnaam mag alleen uit letters bestaan';
  ROLLBACK;
    ELSEIF (p_street = '')
    THEN
     SIGNAL SQLSTATE '45110'
     SET MESSAGE_TEXT = 'Straatnaam moet ingevuld zijn';
    ROLLBACK;
    ELSEIF (!p_zipcode REGEXP '[0-9]{4}[a-zA-Z]{2}')
    THEN
     SIGNAL SQLSTATE '45102'
     SET MESSAGE_TEXT = 'De postcode moet bestaan uit 4 cijfers en 2 letters aan elkaar.';
  ROLLBACK;
  ELSEIF (p_city REGEXP '[^a-zA-Z ]')
    THEN
     SIGNAL SQLSTATE '45103'
     SET MESSAGE_TEXT = 'De plaats mag alleen uit letters bestaan';
  ROLLBACK;
  ELSEIF (p_city = '')
    THEN
     SIGNAL SQLSTATE '45111'
     SET MESSAGE_TEXT = 'Plaats moet ingevuld zijn';
    ROLLBACK;
  ELSEIF (p_housenumberaddon REGEXP '[^a-z]')
    THEN
     SIGNAL SQLSTATE '45104'
     SET MESSAGE_TEXT = 'De toevoeging voor het huisnummer mag alleen uit een kleine letter bestaan';
  ROLLBACK;
    /* Name businessRule  if special characters are used */
    ELSEIF (p_employeelastname REGEXP '[^a-zA-Z ]' || p_employeefirstname REGEXP '[^a-zA-Z ]')
    THEN
     SIGNAL SQLSTATE '45105'
     SET MESSAGE_TEXT = 'De naam mag alleen uit letters bestaan';
  ROLLBACK;
  ELSEIF (p_employeelastname = '' || p_employeefirstname = '')
    THEN
     SIGNAL SQLSTATE '45112'
     SET MESSAGE_TEXT = 'Namen moeten ingevuld zijn';
    ROLLBACK;
  /* Name businessRule  if special characters are used */
    ELSEIF (!p_cellphone REGEXP '^[+][0-9]{11}|[0-9]{10}[^a-zA-Z ]')
    THEN
     SIGNAL SQLSTATE '45106'
     SET MESSAGE_TEXT = 'Geen geldig telefoonnummer';
  ROLLBACK;
/*sex businessRule can only be m or v */
    ELSEIF (p_sex REGEXP '[^MV]')
      THEN
        SIGNAL SQLSTATE '45107'
        SET MESSAGE_TEXT = 'Geen geldig geslacht!';
    ROLLBACK;
    ELSEIF (!p_bsn REGEXP '[0-9]{9}')
      THEN
        SIGNAL SQLSTATE '45108'
        SET MESSAGE_TEXT = 'Bsn moet uit 9 cijfers bestaan!';
    ROLLBACK;
    ELSEIF (p_bsn = '')
      THEN
        SIGNAL SQLSTATE '45113'
        SET MESSAGE_TEXT = 'Bsn moet ingevuld zijn';
    ROLLBACK;
    ELSEIF (select date_add(p_birthday, interval 0 day) IS NULL)
      THEN
        SIGNAL SQLSTATE '45109'
        SET MESSAGE_TEXT = 'Dit is geen geldige geboortedatum';
    ROLLBACK;
    ELSEIF (p_housenumber = 0)
      THEN
        SIGNAL SQLSTATE '45114'
        SET MESSAGE_TEXT = 'Huisnummer moet ingevuld zijn en groter dan 0';
    ROLLBACK;
    ELSE
      CALL sp_GetAddressNumber(p_districtnumber, p_street, p_zipcode, p_housenumber, p_city, p_housenumberaddon, @p_addressnumber);
	  SET p_addressnumber = @p_addressnumber;
      INSERT INTO Employee(addressnumber, employeelastname, employeefirstname, bsn, cellphone, birthday, sex, password)
      VALUES (p_addressnumber, p_employeelastname, p_employeefirstname, p_bsn, p_cellphone, p_birthday, p_sex, p_password);
    COMMIT;
    END IF;
  END //
DELIMITER ;