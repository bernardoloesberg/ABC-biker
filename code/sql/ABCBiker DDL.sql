/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     5/19/2015 9:28:40 AM                         */
/*==============================================================*/


drop table if exists address;

drop table if exists addressforcustomer;

drop table if exists biker;

drop table if exists bus;

drop table if exists consignment;

drop table if exists customer;

drop table if exists dispatcher;

drop table if exists district;

drop table if exists employee;

drop table if exists manager;

drop table if exists parcel;

drop table if exists workingdistrict;

/*==============================================================*/
/* Table: address                                               */
/*==============================================================*/
create table address
(
   addressnumber        int not null AUTO_INCREMENT,
   districtnumber       int,
   street               varchar(40) not null,
   zipcode              varchar(6) not null,
   housenumber          int not null,
   city                 varchar(40) not null,
   housenumberaddon     char(1),
   primary key (addressnumber)
);

/*==============================================================*/
/* Table: addressforcustomer                                    */
/*==============================================================*/
create table addressforcustomer
(
   customernumber       int not null,
   addressnumber        int not null,
   primary key (customernumber, addressnumber)
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
/* Table: bus                                                   */
/*==============================================================*/
create table bus
(
   employeenumber       int not null,
   primary key (employeenumber)
);

/*==============================================================*/
/* Table: consignment                                           */
/*==============================================================*/
create table consignment
(
   consignmentnumber    int not null AUTO_INCREMENT,
   customernumber       int not null,
   deliveraddressnumber int not null,
   pickupaddressnumber  int not null,
   consignorname        varchar(40),
   completed            bool,
   primary key (consignmentnumber)
);

/*==============================================================*/
/* Table: customer                                              */
/*==============================================================*/
create table customer
(
   customernumber       int not null AUTO_INCREMENT,
   customerlastname     varchar(40) not null,
   customerfirstname    varchar(40) not null,
   phonenumber          numeric(14,0) not null,
   sex                  char(1) not null,
   companyname          varchar(40),
   contactlastname      varchar(40),
   contactfirstname     varchar(40),
   email                varchar(50),
   primary key (customernumber)
);

/*==============================================================*/
/* Table: dispatcher                                            */
/*==============================================================*/
create table dispatcher
(
   employeenumber       int not null,
   primary key (employeenumber)
);

/*==============================================================*/
/* Table: district                                              */
/*==============================================================*/
create table district
(
   districtnumber       int not null AUTO_INCREMENT,
   districtname         varchar(40) not null,
   primary key (districtnumber)
);

/*==============================================================*/
/* Table: employee                                              */
/*==============================================================*/
create table employee
(
   employeenumber       int not null AUTO_INCREMENT,
   addressnumber        int not null,
   employeelastname     varchar(40) not null,
   employeefirstname    varchar(40) not null,
   bsn                  int not null,
   cellphone            numeric(14,0) not null,
   birthday             date not null,
   sex                  char(1) not null,
   primary key (employeenumber)
);

/*==============================================================*/
/* Table: manager                                               */
/*==============================================================*/
create table manager
(
   employeenumber       int not null,
   primary key (employeenumber)
);

/*==============================================================*/
/* Table: parcel                                                */
/*==============================================================*/
create table parcel
(
   parcelnumber         int not null AUTO_INCREMENT,
   consignmentnumber    int not null,
   pickupemployeenumber int,
   deliveremployeenumber int,
   tracking             varchar(20) not null,
   weightingrams        int not null,
   pickuptime           datetime,
   deliverytime         datetime,
   primary key (parcelnumber)
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

alter table addressforcustomer add constraint fk_reference_15 foreign key (customernumber)
      references customer (customernumber) on delete restrict on update restrict;

alter table addressforcustomer add constraint fk_reference_16 foreign key (addressnumber)
      references address (addressnumber) on delete restrict on update restrict;

alter table biker add constraint fk_is_a2 foreign key (employeenumber)
      references employee (employeenumber);

alter table bus add constraint fk_is_a foreign key (employeenumber)
      references employee (employeenumber);

alter table consignment add constraint fk_deliveraddress foreign key (deliveraddressnumber)
      references address (addressnumber);

alter table consignment add constraint fk_pickupaddress foreign key (pickupaddressnumber)
      references address (addressnumber);

alter table consignment add constraint fk_placed_by foreign key (customernumber)
      references customer (customernumber);

alter table dispatcher add constraint fk_is_a3 foreign key (employeenumber)
      references employee (employeenumber);

alter table employee add constraint fk_lives_at foreign key (addressnumber)
      references address (addressnumber);

alter table manager add constraint fk_is_a4 foreign key (employeenumber)
      references employee (employeenumber);

alter table parcel add constraint fk_has foreign key (consignmentnumber)
      references consignment (consignmentnumber);

alter table parcel add constraint fk_is_delivered_by foreign key (deliveremployeenumber)
      references employee (employeenumber);

alter table parcel add constraint fk_is_picked_up_by foreign key (pickupemployeenumber)
      references employee (employeenumber);

alter table workingdistrict add constraint fk_covers_a foreign key (districtnumber)
      references district (districtnumber);

alter table workingdistrict add constraint fk_number_of foreign key (employeenumber)
      references employee (employeenumber);

