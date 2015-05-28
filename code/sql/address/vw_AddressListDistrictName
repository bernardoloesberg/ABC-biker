/*
 *@Author: Christiaan ten Voorde
 */
use abcbiker;

DROP VIEW vw_AddressListDistrictName;

CREATE VIEW vw_AddressListDistrictName
AS
SELECT ad.addressnumber, ad.street, ad.zipcode, ad.housenumber, ad.housenumberaddon, ad.city, di.districtname FROM Address ad JOIN District di ON ad.districtnumber = di.districtnumber;