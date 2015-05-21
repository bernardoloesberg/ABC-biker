/*=====================================================================*/
/* DBMS name:      MySQL 5.0                                           */
/* Created on:     5/21/2015 11:46:17 AM                               */
/* Created By:     Tom Kooiman                                         */
/* Version:        3.0.1    build 1 - parcel employee numbers changed  */
/*=====================================================================*/
drop table if exists address;

drop table if exists addressforcustomer;

drop table if exists biker;

drop table if exists consignment;

drop table if exists consignmenthistory;

drop table if exists customer;

drop table if exists customercontact;

drop table if exists district;

drop table if exists employee;

drop table if exists parcel;

drop table if exists price;

drop table if exists role;

drop table if exists rolesperemployee;

drop table if exists workingdistrict;

/*==============================================================*/
/* Table: address                                               */
/*==============================================================*/
create table address
(
   addressnumber        int not null,
   districtnumber       int not null,
   street               varchar(40) not null,
   zipcode              varchar(6) not null,
   housenumber          int not null,
   housenumberaddon     char(1),
   city                 varchar(40) not null,
   primary key (addressnumber)
);

/*==============================================================*/
/* Table: addressforcustomer                                    */
/*==============================================================*/
create table addressforcustomer
(
   addressnumber        int not null,
   customernumber       int not null,
   primary key (addressnumber, customernumber)
);

/*==============================================================*/
/* Table: biker                                                 */
/*==============================================================*/
create table biker
(
   employeenumber       int not null,
   express              bool not null,
   maxdeliveries        int not null,
   primary key (employeenumber)
);

/*==============================================================*/
/* Table: consignment                                           */
/*==============================================================*/
create table consignment
(
   consignmentnumber    int not null,
   customernumber       int not null,
   addressnumber        int not null,
   consignorname        varchar(40),
   completed            bool,
   scheduledpickup      datetime,
   scheduleddelivery    datetime,
   price                float(6,2),
   totalprice           float(6,2),
   primary key (consignmentnumber)
);

/*==============================================================*/
/* Table: consignmenthistory                                    */
/*==============================================================*/
create table consignmenthistory
(
   historynumber        int not null,
   consignmentnumber    int not null,
   employeenumber       int not null,
   comment              text not null,
   primary key (historynumber)
);

/*==============================================================*/
/* Table: customer                                              */
/*==============================================================*/
create table customer
(
   customernumber       int not null,
   customerlastname     varchar(40) not null,
   customerfirstname    varchar(40) not null,
   phonenumber          varchar(14) not null,
   sex                  char(1) not null,
   companyname          varchar(40),
   email                varchar(50),
   password             varchar(24),
   primary key (customernumber)
);

/*==============================================================*/
/* Table: customercontact                                       */
/*==============================================================*/
create table customercontact
(
   contactnumber        int not null,
   customernumber       int not null,
   contactlastname      varchar(40) not null,
   contactfirstname     varchar(40) not null,
   contactphonenumber   varchar(14) not null,
   contactemail         varchar(50),
   contactdepartment    varchar(40),
   primary key (contactnumber)
);

/*==============================================================*/
/* Table: district                                              */
/*==============================================================*/
create table district
(
   districtnumber       int not null,
   districtname         varchar(40) not null,
   primary key (districtnumber)
);

/*==============================================================*/
/* Table: employee                                              */
/*==============================================================*/
create table employee
(
   employeenumber       int not null,
   addressnumber        int not null,
   employeelastname     varchar(40) not null,
   employeefirstname    varchar(40) not null,
   bsn                  int not null,
   cellphone            varchar(14) not null,
   birthday             date not null,
   sex                  char(1) not null,
   password             varchar(24) not null,
   primary key (employeenumber)
);

/*==============================================================*/
/* Table: parcel                                                */
/*==============================================================*/
create table parcel
(
   consignmentnumber    int not null,
   parcelnumber         int not null,
   pickupemployeenumber int,
   deliveremployeenumber int,
   addressnumber        int not null,
   weightingrams        int not null,
   pickup               datetime,
   delivery             datetime,
   hqarrival            datetime,
   hqdeparture          datetime,
   comment              text,
   primary key (consignmentnumber, parcelnumber)
);

/*==============================================================*/
/* Table: price                                                 */
/*==============================================================*/
create table price
(
   pricepergram         float(6,2) not null,
   primary key (pricepergram)
);

/*==============================================================*/
/* Table: role                                                  */
/*==============================================================*/
create table role
(
   rolename             varchar(40) not null,
   primary key (rolename)
);

/*==============================================================*/
/* Table: rolesperemployee                                      */
/*==============================================================*/
create table rolesperemployee
(
   rolename             varchar(40) not null,
   employeenumber       int not null,
   primary key (rolename, employeenumber)
);

/*==============================================================*/
/* Table: workingdistrict                                       */
/*==============================================================*/
create table workingdistrict
(
   districtnumber       int not null,
   employeenumber       int not null,
   weeknumber           int not null,
   primary key (districtnumber, employeenumber, weeknumber)
);

alter table address add constraint fk_lies_in foreign key (districtnumber)
      references district (districtnumber);

alter table addressforcustomer add constraint fk_addressforcustomer foreign key (addressnumber)
      references address (addressnumber);

alter table addressforcustomer add constraint fk_addressforcustomer2 foreign key (customernumber)
      references customer (customernumber);

alter table biker add constraint fk_as foreign key (employeenumber)
      references employee (employeenumber);

alter table consignment add constraint fk_pickupaddress foreign key (addressnumber)
      references address (addressnumber);

alter table consignment add constraint fk_placed_by foreign key (customernumber)
      references customer (customernumber);

alter table consignmenthistory add constraint fk_edited_by foreign key (employeenumber)
      references employee (employeenumber);

alter table consignmenthistory add constraint fk_history_of foreign key (consignmentnumber)
      references consignment (consignmentnumber);

alter table customercontact add constraint fk_contact_from foreign key (customernumber)
      references customer (customernumber);

alter table employee add constraint fk_lives_at foreign key (addressnumber)
      references address (addressnumber);

alter table parcel add constraint fk_deliveraddress foreign key (addressnumber)
      references address (addressnumber);

alter table parcel add constraint fk_has foreign key (consignmentnumber)
      references consignment (consignmentnumber);

alter table parcel add constraint fk_is_delivered_by foreign key (deliveremployeenumber)
      references employee (employeenumber);

alter table parcel add constraint fk_is_picked_up_by foreign key (pickupemployeenumber)
      references employee (employeenumber);

alter table rolesperemployee add constraint fk_is_a foreign key (rolename)
      references role (rolename);

alter table rolesperemployee add constraint fk_is_a2 foreign key (employeenumber)
      references employee (employeenumber);

alter table workingdistrict add constraint fk_covers_a foreign key (districtnumber)
      references district (districtnumber);

alter table workingdistrict add constraint fk_number_of foreign key (employeenumber)
      references employee (employeenumber);

