/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     5/12/2015 1:33:23 PM                         */
/*==============================================================*/


drop table if exists address;

drop table if exists addressforcustomer;

drop table if exists biker;

drop table if exists bus;

drop table if exists consigment;

drop table if exists customer;

drop table if exists dispatcher;

drop table if exists district;

drop table if exists employee;

drop table if exists manager;

drop table if exists parcel;

drop table if exists workingdistrict;

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
/* Table: address                                               */
/*==============================================================*/
create table address
(
   addressnumber        int not null,
   dirstrictnumber      int not null,
   street               varchar(40) not null,
   zipcode              varchar(6) not null,
   housenumber          int not null,
   city                 varchar(40) not null,
   housenumberaddon     char(1),
   primary key (addressnumber),
   constraint fk_lies_in foreign key (dirstrictnumber)
      references district (districtnumber)
);

/*==============================================================*/
/* Table: customer                                              */
/*==============================================================*/
create table customer
(
   customernumber       int not null,
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
/* Table: addressforcustomer                                    */
/*==============================================================*/
create table addressforcustomer
(
   customernumber       int not null,
   addressnumber        int not null,
   primary key (customernumber, addressnumber),
   constraint fk_reference_15 foreign key (customernumber)
      references customer (customernumber) on delete restrict on update restrict,
   constraint fk_reference_16 foreign key (addressnumber)
      references address (addressnumber) on delete restrict on update restrict
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
   cellphone            numeric(14,0) not null,
   birthday             date not null,
   sex                  char(1) not null,
   primary key (employeenumber),
   constraint fk_lives_at foreign key (addressnumber)
      references address (addressnumber)
);

/*==============================================================*/
/* Table: biker                                                 */
/*==============================================================*/
create table biker
(
   employeenumber       int not null,
   express              bool not null,
   maxdeleveries        int not null,
   primary key (employeenumber),
   constraint fk_is_a2 foreign key (employeenumber)
      references employee (employeenumber)
);

/*==============================================================*/
/* Table: bus                                                   */
/*==============================================================*/
create table bus
(
   employeenumber       int not null,
   primary key (employeenumber),
   constraint fk_is_a foreign key (employeenumber)
      references employee (employeenumber)
);

/*==============================================================*/
/* Table: consigment                                            */
/*==============================================================*/
create table consigment
(
   consignmentnumber    int not null,
   customernumber       int not null,
   deliveraddressnumber int not null,
   pickupaddressnumber  int not null,
   consignorname        varchar(40),
   primary key (consignmentnumber),
   constraint fk_placed_by foreign key (customernumber)
      references customer (customernumber),
   constraint fk_deliveraddress foreign key (deliveraddressnumber)
      references address (addressnumber),
   constraint fk_pickupaddress foreign key (pickupaddressnumber)
      references address (addressnumber)
);

/*==============================================================*/
/* Table: dispatcher                                            */
/*==============================================================*/
create table dispatcher
(
   employeenumber       int not null,
   primary key (employeenumber),
   constraint fk_is_a3 foreign key (employeenumber)
      references employee (employeenumber)
);

/*==============================================================*/
/* Table: manager                                               */
/*==============================================================*/
create table manager
(
   employeenumber       int not null,
   primary key (employeenumber),
   constraint fk_is_a4 foreign key (employeenumber)
      references employee (employeenumber)
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
   tracking             varchar(20) not null,
   weightingrams        int not null,
   pickuptime           datetime,
   deliverytime         datetime,
   primary key (consignmentnumber, parcelnumber),
   constraint fk_is_picked_up_by foreign key (pickupemployeenumber)
      references employee (employeenumber),
   constraint fk_is_delivered_by foreign key (deliveremployeenumber)
      references employee (employeenumber),
   constraint fk_has foreign key (consignmentnumber)
      references consigment (consignmentnumber)
);

/*==============================================================*/
/* Table: workingdistrict                                       */
/*==============================================================*/
create table workingdistrict
(
   districtnumber       int not null,
   employeenumber       int not null,
   weeknumber           int not null,
   primary key (districtnumber, employeenumber, weeknumber),
   constraint fk_covers_a foreign key (districtnumber)
      references district (districtnumber),
   constraint fk_number_of foreign key (employeenumber)
      references employee (employeenumber)
);

