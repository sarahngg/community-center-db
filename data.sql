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
 
/*Customer Table Insertions*/
insert into Customer values('nathanyan@email.com', 'Nathan', 'Yan');
insert into Customer values('jdoe@gmail.com', 'John', 'Doe');
insert into Customer values('smithk@hotmail.com', 'Karen', 'Smith');
insert into Customer values('rreynolds02@gmail.com', 'Ryan', 'Reynolds');
insert into Customer values('opwinfrey@email.com', 'Oprah', 'Winfrey');
insert into Customer values('kelly.smith@hotmail.com', 'Kelly', 'Smith');
insert into Customer values('rng@ubc.ca', 'Raymond', 'Ng');
insert into Customer values('eknorr@ubc.ca', 'Ed', 'Knorr');

/*Takes Table Insertions*/
insert into Takes values('smithk@hotmail.com', 105, date '2020-10-20', 12.00);
insert into Takes values('rng@ubc.ca', 107, date '2020-09-05', 18.50);
insert into Takes values('rng@ubc.ca', 107, date '2020-09-07', 18.50);
insert into Takes values('jdoe@gmail.com', 75, date '2020-09-27', 9.50);
insert into Takes values('jdoe@gmail.com', 78, date '2020-10-04', 13.25);

/*Process-Purchase-Membership Insertions*/
insert into Process_Purchase_Membership values(1, 50, 'nathanyan@email.com', date '2020-02-12', 1, 184);
insert into Process_Purchase_Membership values(2, 100, 'jdoe@gmail.com', date '2020-03-29', 2, 42);
insert into Process_Purchase_Membership values(3, 50, 'rreynolds02@gmail.com', date '2020-05-08', 3, 21);
insert into Process_Purchase_Membership values(4, 150, 'opwinfrey@email.com', date '2020-06-14', 4, 42);
insert into Process_Purchase_Membership values(5, 200, 'kelly.smith@hotmail.com', date '2020-06-28', 5, 90);
insert into Process_Purchase_Membership values(6, 100, 'rng@ubc.ca', date '2020-08-02', 6, 121);
insert into Process_Purchase_Membership values(7, 50, 'eknorr@ubc.ca', date '2020-09-21', 7, 124); 

/*Class-Leads Insertions*/
insert into Class_Leads values(105, date '2020-10-23', 0.30, "Lecture", "Food Safe 1", 50, 30);
insert into Class_Leads values(105, date '2020-10-24', 0.30, "Lecture", "Food Safe 2", 50, 30);
insert into Class_Leads values(232, date '2020-10-23', 0.10, "Training", "Intro to CPR", 25, 200);
insert into Class_Leads values(232, date '2020-10-24', 0.10, "Training", "CPR Recertification", 25, 200);
insert into Class_Leads values(167, date '2020-10-25', 0.30, "Lecture", "HTML/CSS Level 1", 50, 88);
insert into Class_Leads values(78, date '2020-10-23', 0, "Hands-on", "Pottery: Beginners", 20, 65);
insert into Class_Leads values(78, date '2020-10-30', 0, "Hands-on", "Pottery: Intermediate", 20, 65);
insert into Class_Leads values(107, date '2020-10-23', 0.20, "Fitness", "Yoga", 15, 31);
insert into Class_Leads values(111, date '2020-10-24', 0.20, "Fitness", "Pilates", 15, 31);
insert into Class_Leads values(202, date '2020-10-25', 0, "Discussion", "English for New Canadians", 10, 144);
insert into Class_Leads values(301, date '2020-10-26', 0.10, "Training", "Computer for Seniors", 25, 0);


insert into employee values(199, 'Greedy', 'Manager');

insert into pays_payment values(date '2019-01-01', 400, 199, 40.02);