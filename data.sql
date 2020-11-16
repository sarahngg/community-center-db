drop table Takes;
drop table Process_Purchase_Membership;
drop table Uses;
drop table Has_Room_Booking;
drop table Workshop;
drop table Lesson;
drop table Front_Desk_Staff;
drop table Instructor;
drop table Pays_Payment;
drop table Orders_Equipment;
drop table Orders_Equipment_R5;
drop table Orders_Equipment_R7;
drop table Orders_Equipment_R8;
drop table Class_Leads;
drop table Class_Leads_R3;
drop table Class_Leads_R4;
drop table Class_Leads_R1;
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

CREATE TABLE Employee (
  eID int,
  firstName char(50),
  lastName char(50),
  PRIMARY KEY (eID)
);
grant select on Employee to public;

CREATE TABLE Class_Leads (
  classID int, 
  "date" date, 
  memberDiscount real, 
  classType char(50), 
  className char(50), 
  maxSpots int, 
  eID int,
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (eID) REFERENCES Employee ON DELETE SET NULL
);
grant select on Class_Leads to public;

CREATE TABLE Orders_Equipment (
  equipmentID int,
  cost real, 
  "name" char(50), 
  SKU int, 
  orderNum int, 
  eID int DEFAULT 0 NOT NULL,
  PRIMARY KEY (equipmentID),
  FOREIGN KEY (eID) REFERENCES Employee 
);
grant select on Orders_Equipment to public;

CREATE TABLE Takes (
  email char(50), 
  classID int, 
  "date" date, 
  billedAmount real,
  PRIMARY KEY(email, classID, "date"),
  FOREIGN KEY(email) REFERENCES Customer ON DELETE CASCADE,
  FOREIGN KEY(classID, "date") REFERENCES Class_Leads ON DELETE CASCADE
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

CREATE TABLE Has_Room_Booking (
  roomNum int,
  timeSlot timestamp(0), --24-JAN-12 05.57.12 AM
  classID int,
  "date" date,
  PRIMARY KEY (roomNum, timeSlot),
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads ON DELETE SET NULL
);
grant select on Has_Room_Booking to public;

CREATE TABLE Workshop (
  classID int,
  "date" date,
  "certificate" char(50),
  oneTimeFee real,
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads ON DELETE CASCADE
);
grant select on Workshop to public;

CREATE TABLE Lesson (
  classID int,
  "date" date,
  weeklyRate real,
  PRIMARY KEY (classID, "date"),
  FOREIGN KEY (classID, "date") REFERENCES Class_Leads ON DELETE CASCADE
);
grant select on Lesson to public;

CREATE TABLE Uses (
  classID int, 
  "date" date, 
  equipmentID int,
  PRIMARY KEY(classID, "date", equipmentID),
  FOREIGN KEY(classID, "date") REFERENCES Class_Leads ON DELETE CASCADE,
  FOREIGN KEY(equipmentID) REFERENCES Orders_Equipment ON DELETE CASCADE
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

/* Lesson Table Insertions */
insert into Lesson values(78, date '2020-10-23', 18.50);
insert into Lesson values(78, date '2020-10-30', 18.50);
insert into Lesson values(107, date '2020-10-23', 25.00);
insert into Lesson values(111, date '2020-10-24', 12.00);
insert into Lesson values(202, date '2020-10-23', 0.00);

/* Uses Table Insertions */
insert into Uses values(78, date '2020-10-23', 26623);
insert into Uses values(78, date '2020-10-30', 43241);
insert into Uses values(105, date '2020-10-23', 11267);
insert into Uses values(232, date '2020-10-24', 64671);
insert into Uses values(202, date '2020-10-25', 64672);

/* Orders_Equipment Table Insertions */
insert into Orders_Equipment values(26623, 9.99, 'Potter's Wheel', 280775733, 611, 184);
insert into Orders_Equipment values(43241, 6.99, 'Kiln', 568349684, 112, 42);
insert into Orders_Equipment values(11267, 12.99, 'Meat Thermometer', 928832138, 442, 21);
insert into Orders_Equipment values(64671, 19.99, 'Large Exercise Mat', 212530810, 31, 90);
insert into Orders_Equipment values(64672, 15.00, 'Kindle Reader', 831551818, 82, 121);

/* Employee Table Insertions */
insert into Employee values(184, 'Bob', 'Smith');
insert into Employee values(42, 'Ronald', 'McDonald');
insert into Employee values(21, 'Lisa', 'Simpson');
insert into Employee values(90, 'Awkwa', 'Fina');
insert into Employee values(121, 'Steve', 'Rogers');
insert into Employee values(30, 'Homer', 'Simpson');
insert into Employee values(31, 'Britney', 'Spears');
insert into Employee values(88, 'Patrick', 'Star');
insert into Employee values(65, 'Ash', 'Ketchum');
insert into Employee values(144, 'Justin', 'Trudeau');
insert into Employee values(199, 'Greedy', 'Manager');
insert into Employee values(200, 'Anne', 'Rescue');

/* Front_Desk_Staff Table Insertions */
insert into Front_Desk_Staff values(184, 18.72);
insert into Front_Desk_Staff values(42, 25.30);
insert into Front_Desk_Staff values(21, 17.17);
insert into Front_Desk_Staff values(90, 24.30);
insert into Front_Desk_Staff values(121, 23.10);

/* Instructor Table Insertions */
insert into Instructor values(30, 32.33, 'Culinary');
insert into Instructor values(31, 29.00, 'Yoga');
insert into Instructor values(88, 38.53, 'IT & Web Development');
insert into Instructor values(65, 34.05, 'Pottery');
insert into Instructor values(200, 50.21, 'CPR');
insert into Instructor values(144, 26.27, 'English');

/* Pays_Payment Table Insertions */
insert into Pays_Payment values(date '2020-09-30', 432, 30, 323.30);
insert into Pays_Payment values(date '2020-10-30', 433, 31, 290.00);
insert into Pays_Payment values(date '2020-10-30', 434, 88, 385.30);
insert into Pays_Payment values(date '2020-10-30', 435, 65, 340.50);
insert into Pays_Payment values(date '2020-10-30', 436, 121, 2310.30);
insert into Pays_Payment values(date '2020-11-15', 437, 65, 202.10);