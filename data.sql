drop table Takes;
drop table Process_Purchase_Membership;
drop table Uses;
drop table Class_Leads_R3;
drop table Class_Leads_R4;
drop table Class_Leads_R1;
drop table Has_Room_Booking;
drop table Workshop;
drop table Lesson;
drop table Orders_Equipment_R5;
drop table Orders_Equipment_R7;
drop table Orders_Equipment_R8;
drop table Front_Desk_Staff;
drop table Instructor;
drop table Pays_Payment;
drop table Employee;
drop table Customer;
-- select table_name from user_tables;

CREATE TABLE Customer (
  email char(50),
  firstName char(50), 
  lastName char(50),
  PRIMARY KEY (email)
);
grant select on Customer to public;

CREATE TABLE Class_Leads_R3 (
  classType char(50),
  maxSpots int,
  memberDiscount real,
  PRIMARY KEY (ClassType)
);
grant select on Class_Leads_R3 to public;

CREATE TABLE Orders_Equipment_R7 (
  SKU int,
  cost real,
  PRIMARY KEY (SKU)
);
grant select on Orders_Equipment_R7 to public;

CREATE TABLE Employee (
  eID int,
  firstName char(50),
  lastName char(50),
  PRIMARY KEY (eID)
);
grant select on Employee to public;

CREATE TABLE Class_Leads_R1 (
  classID int,
  "date" date,
  className char(50),
  classType char(50),
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (classType) REFERENCES Class_Leads_R3(classType) ON DELETE SET NULL 
);
grant select on Class_Leads_R1 to public;

CREATE TABLE Takes (
  email char(50), 
  classID int, 
  "date" date, 
  billedAmount real,
  PRIMARY KEY(email, classID, "date"),
  FOREIGN KEY(email) REFERENCES Customer ON DELETE CASCADE,
  FOREIGN KEY(classID, "date") REFERENCES Class_Leads_R1 ON DELETE CASCADE
);
grant select on Takes to public;

CREATE TABLE Process_Purchase_Membership (
  mID int,
  cost real,
  email char(50) DEFAULT 'n/a' NOT NULL,
  purchaseDate date, 
  confirmationNum int, 
  eID int DEFAULT 0 NOT NULL,
  PRIMARY KEY (mID),
  FOREIGN KEY (email) REFERENCES Customer (email),
  FOREIGN KEY (eID) REFERENCES Employee (eID) 
);
grant select on Process_Purchase_Membership to public;

CREATE TABLE Class_Leads_R4 (
  classID int,
  "date" date,
  eID int,
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (eID) REFERENCES Employee ON DELETE SET NULL, 
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads_R1 
    ON DELETE SET NULL 
);
grant select on Class_Leads_R4 to public;

CREATE TABLE Has_Room_Booking (
  roomNum int,
  timeSlot timestamp(0), --24-JAN-12 05.57.12 AM
  classID int,
  "date" date,
  PRIMARY KEY (roomNum, timeSlot),
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads_R1 ON DELETE SET NULL
);
grant select on Has_Room_Booking to public;

CREATE TABLE Workshop (
  classID int,
  "date" date,
  "certificate" char(50),
  oneTimeFee real,
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads_R1 ON DELETE CASCADE
);
grant select on Workshop to public;

CREATE TABLE Lesson (
  classID int,
  "date" date,
  weeklyRate real,
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads_R1 ON DELETE CASCADE
);
grant select on Lesson to public;

CREATE TABLE Orders_Equipment_R5 (
  equipmentID int,
  "name" char(50),
  eID int DEFAULT 0 NOT NULL,
  PRIMARY KEY(equipmentID),
  FOREIGN KEY(eID) REFERENCES Employee 
);
grant select on Orders_Equipment_R5 to public;

CREATE TABLE Orders_Equipment_R8 (
  equipmentID int,
  SKU int,
  orderNum int,
  PRIMARY KEY(equipmentID),
  FOREIGN KEY(SKU) REFERENCES Orders_Equipment_R7,
  FOREIGN KEY(equipmentID) REFERENCES Orders_Equipment_R5 ON DELETE SET NULL
);
grant select on Orders_Equipment_R8 to public;

CREATE TABLE Uses (
  classID int, 
  "date" date, 
  equipmentID int,
  PRIMARY KEY(classID, "date", equipmentID),
  FOREIGN KEY(classID, "date") REFERENCES Class_Leads_R1 ON DELETE CASCADE,
  FOREIGN KEY(equipmentID) REFERENCES Orders_Equipment_R5 ON DELETE CASCADE
);
grant select on Uses to public;

CREATE TABLE Front_Desk_Staff (
  eID int, 
  hourlyRate real, 
  PRIMARY KEY(eID),
  FOREIGN KEY(eID) REFERENCES Employee ON DELETE CASCADE
);
grant select on Front_Desk_Staff to public;

CREATE TABLE Instructor (
  eID int, 
  programRate real, 
  specialization char(50),
  PRIMARY KEY(eID),
  FOREIGN KEY(eID) REFERENCES Employee ON DELETE CASCADE
);
grant select on Instructor to public;

CREATE TABLE Pays_Payment (
  "date" date, 
  payrollID int, 
  eID int NOT NULL, 
  amount real,
  PRIMARY KEY("date", payrollID),
  FOREIGN KEY(eID) REFERENCES Employee
);
grant select on Pays_Payment to public;

select table_name from user_tables;
 

insert into customer values('nathanyan@email.com', 'Nathan', 'Yan');

insert into employee values(199, 'Greedy', 'Manager');

insert into pays_payment values(date '2019-01-01', 400, 199, 40.02);