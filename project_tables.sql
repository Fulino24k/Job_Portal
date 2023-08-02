-- DROP TABLES

drop table Applicant;
drop table CreateAccount;
drop table StoreApplication;
drop table ProduceApplication;
drop table CoverLetter;
drop table Resume;
drop table AppliesFor;
drop table AcceptDenyOffer;
drop table Draft;
drop table Creates;
drop table R1_PositionNameTeam;
drop table R3_EmployeeNumName;
drop table R5_EmployeeNumPosition;
drop table R7_EmailPhone;
drop table R8_EmployeeNumEmail;
drop table Supervisor;
drop table HiringManager;
drop table Conducts;
drop table Interview;
drop table Reviews;
drop table JR1_ScheduleSalary;
drop table JR3_ID_SpotNum;
drop table JR5_PositionDuties;
drop table JR7_DutyQualifications;
drop table JR9_ID_Qualifications;
drop table JR10_ID_Shift;

-- CREATE TABLES

CREATE TABLE Applicant(
applicant_email CHAR(30) PRIMARY KEY,
name CHAR(30),
phone_num INTEGER UNIQUE,
address CHAR(30)
);	

-- Employer Entities R1 - R8

CREATE TABLE R1_PositionNameTeam(
PrimaryPosition CHAR(30),
EmpName CHAR(30),
Team CHAR(30),
PRIMARY KEY(PrimaryPosition, EmpName)
)

CREATE TABLE R3_EmployeeNumName(
employee_num INTEGER PRIMARY KEY,
EmpName CHAR(30)
)

CREATE TABLE R5_EmployeeNumPosition(
employee_num INTEGER PRIMARY KEY,
PrimaryPosition CHAR(30)
)

CREATE TABLE R7_EmailPhone(
emp_email CHAR(30) PRIMARY KEY,
emp_phone_num: INTEGER,
)

CREATE TABLE R8_EmployeeNumEmail(
emp_phone_num INTEGER,
emp_email CHAR(30),
PRIMARY KEY(emp_phone_num, emp_email)
)

CREATE TABLE CreateAccount(
applicant_email CHAR(30),
account_acc_num INTEGER  PRIMARY KEY,
FOREIGN KEY (applicant_email) REFERENCES Applicant(applicant_mail)
);

CREATE TABLE StoreApplication(
job_app_num INTEGER PRIMARY KEY ,
ApplyDate INTEGER,
account_acc_num INTEGER,
FOREIGN KEY (account-acc#) REFERENCES CreateAccount(account_acc_num)
);

CREATE TABLE ProduceApplication(
produceApp_num INTEGER PRIMARY KEY,
ApplyDate INTEGER,
produceEmail CHAR(30), 
FOREIGN KEY(produceEmail) REFERENCES Applicant(applicant_email)
)

CREATE TABLE CoverLetter(
job_app_num CHAR(30) PRIMARY KEY,
introduction CHAR(300),
FOREIGN KEY(job_app_num) REFERENCES StoreApplication(job_app_num)
);

CREATE TABLE Resume(
job_app_num CHAR(30) PRIMARY KEY,
education CHAR(300),
experience CHAR(300),
resName CHAR(30),
FOREIGN KEY(job_app_num) REFERENCES StoreApplication(job_app_num)
);

CREATE TABLE AcceptDenyOffer(
offer_employee_num INTEGER PRIMARY KEY,
StartDate INTEGER,
applicant_email CHAR(30),
FOREIGN KEY(applicant_email) REFERENCES Applicant(applicant_email)
);

CREATE TABLE Draft(
offer_employee_num INTEGER,
emp_employee_num INTEGER,
PRIMARY KEY(offer_employee_num, emp_employee_num)
FOREIGN KEY(offer_employee_num) REFERENCES AcceptDenyOffer(offer_employee_num)
FOREIGN KEY(emp_employee_num) REFERENCES R3_EmployeeNumName(employee_num)
);

CREATE TABLE Creates(
job_referID INTEGER,
emp_employee_num INTEGER,
PRIMARY KEY(job_referID, emp_employee_num),
FOREIGN KEY (job_referID) REFERENCES JobListing(referenceID),
FOREIGN KEY (emp_employee_num) REFERENCES R3_EmployeeNumName(employee_num)
);

CREATE TABLE Supervisor(
emp_employee_num INTEGER PRIMARY KEY, 
fieldProject CHAR(30),
FOREIGN KEY (emp_employee_num) REFERENCES R3_EmployeeNumName(employee_num)
);

CREATE TABLE HiringManager(
emp_employee_num INTEGER  PRIMARY KEY, 
department CHAR(30), 
FOREIGN KEY (emp_employee_num) REFERENCES R3_EmployeeNumName(employee_num)
);

CREATE TABLE Interview(
date INTEGER,
interviewer CHAR(30),
interviewee CHAR(30),
PRIMARY KEY (date, interviewer, interviewee)
);

CREATE TABLE Conducts(
emp_employee_num INTEGER, 
date INTEGER,
interviewer CHAR(30),
interviewee CHAR(30),
PRIMARY (emp_employee_num, date, interviewer, interviewee),
FOREIGN KEY (emp_employee_num) REFERENCES R3_EmployeeNumName(employee_num),
FOREIGN KEY (date) REFERENCES Interview(date),
FOREIGN KEY (interviewer) REFERENCES Interview(interviewer),
FOREIGN KEY (interviewee) REFERENCES Interview(interviewee)
);

CREATE TABLE Reviews(
job_app_num INTEGER,
emp_employee_num INTEGER, 
PRIMARY KEY (job_app_num, emp_employee_num)
FOREIGN KEY (job_app_num ) REFERENCES StoreApplication(account_acc_num)
FOREIGN KEY (emp_employee_num) REFERENCES R3_EmployeeNumName(employee_num)
)

-- Job Listing Entities JR1 - JR10

CREATE TABLE JR1_ScheduleSalary(
ShiftSchedule CHAR(30) PRIMARY KEY,
Salary INTEGER
)

CREATE TABLE JR3_ID_SpotNum(
ReferenceID INTEGER PRIMARY KEY,
num_of_Spots INTEGER
)

CREATE TABLE JR5_PositionDuties(
Duties CHAR(3000) PRIMARY KEY,
PositionName CHAR(30)
)

CREATE TABLE JR7_DutyQualifications(
Qualifications CHAR(3000) PRIMARY KEY,
Duties CHAR(3000)
)

CREATE TABLE JR9_ID_Qualifications(
ReferenceID INTEGER PRIMARY KEY,
Qualifications CHAR(3000)
)

CREATE TABLE JR10_ID_Shift(
ReferenceID INTEGER,
ShiftSchedule CHAR(30),
PRIMARY KEY(ReferenceID, ShiftSchedule)
)

CREATE TABLE AppliesFor(
applyEmail CHAR(30),
applyReferenceID INTEGER,
PRIMARY KEY(applyEmail, applyReferenceID),
FOREIGN KEY(applyEmail) REFERENCES Applicant(applicant_email),
FOREIGN KEY(applyReferenceID) REFERENCES JR3_ID_SpotNum(ReferenceID)
)

-- INSERTION STATEMENTS

-- Applicant

INSERT INTO Applicant(applicant_email, name, phone_num, address)
VALUES('sean@gmail.com', 'Sean', 2362844844, '4472 Steeles Ave E, Markham, ON L3R 0L4')

INSERT INTO Applicant(applicant_email, name, phone_num, address)
VALUES('dani@gmail.com', 'Dani', 7785754724, '23 Drewry Ave, Toronto, ON M2M 2E4')

INSERT INTO Applicant(applicant_email, name, phone_num, address)
VALUES('aaron@gmail.com', 'Aaron', 7784929582, '565 Bernard Ave #14, Kelowna, BC V1Y 8R2')

INSERT INTO Applicant(applicant_email, name, phone_num, address)
VALUES('gittu@gmail.com', 'Gittu', 6043841737, '10370 82 Ave NW, Edmonton, AB T6E 4E7')

INSERT INTO Applicant(applicant_email, name, phone_num, address)
VALUES('yan@gmail.com', 'Yan', 2363727371, '2435 Ch Duncan, Mount-Royal, QC H4P 2A2')

-- R1 (Position & Name of Employer)

INSERT INTO R1_PositionNameTeam(PrimaryPosition, EmpName, Team)
VALUES('Communication', 'Bill Gates', 1)

INSERT INTO R1_PositionNameTeam(PrimaryPosition, EmpName, Team)
VALUES('Marketing Management', 'Steve Jobs', 4)

INSERT INTO R1_PositionNameTeam(PrimaryPosition, EmpName, Team)
VALUES('Customer Service', 'Elon Musk', 3)

INSERT INTO R1_PositionNameTeam(PrimaryPosition, EmpName, Team)
VALUES('Sales', 'Jeff Bezos', 2)

INSERT INTO R1_PositionNameTeam(PrimaryPosition, EmpName, Team)
VALUES('Cook', 'Tim Cook', 3)

INSERT INTO R1_PositionNameTeam(PrimaryPosition, EmpName, Team)
VALUES('Finance', 'Jack Ma', 5)

-- R3 Employer Number and Name

INSERT INTO R3_EmployeeNumName(employee_num, EmpName)
VALUES(1111, 'Bill Gates')

INSERT INTO R3_EmployeeNumName(employee_num, EmpName)
VALUES(2222, 'Steve Jobs')

INSERT INTO R3_EmployeeNumName(employee_num, EmpName)
VALUES(3333, 'Elon Musk')

INSERT INTO R3_EmployeeNumName(employee_num, EmpName)
VALUES(4444, 'Jeff Bezos')

INSERT INTO R3_EmployeeNumName(employee_num, EmpName)
VALUES(5555, 'Tim Cook')

INSERT INTO R3_EmployeeNumName(employee_num, EmpName)
VALUES(666, 'Jack Ma')

-- R5 Employer Number and Position

INSERT INTO R5_EmployeeNumPosition(employee_num, PositionName)
VALUES(1111, 'Communication')

INSERT INTO R5_EmployeeNumPosition(employee_num, PositionName)
VALUES(2222, 'Marketing Management')

INSERT INTO R5_EmployeeNumPosition(employee_num, PositionName)
VALUES(3333, 'Customer Service')

INSERT INTO R5_EmployeeNumPosition(employee_num, PositionName)
VALUES(4444, 'Sales')

INSERT INTO R5_EmployeeNumPosition(employee_num, PositionName)
VALUES(5555, 'Cook')

INSERT INTO R5_EmployeeNumPosition(employee_num, PositionName)
VALUES(6666, 'Finance')

-- R7 Employer Email and Phone

INSERT INTO R7_EmailPhone(emp_email, emp_phone_num)
VALUES('bill@gmail.com', 2363432123)

INSERT INTO R7_EmailPhone(emp_email, emp_phone_num)
VALUES('steve@gmail.com', 7783049193)

INSERT INTO R7_EmailPhone(emp_email, emp_phone_num)
VALUES('Elon@gmail.com', 7784939185)

INSERT INTO R7_EmailPhone(emp_email, emp_phone_num)
VALUES('Jeff@gmail.com', 2365838384)

INSERT INTO R7_EmailPhone(emp_email, emp_phone_num)
VALUES('whoLetTimCook@gmail.com', 6045818385)

INSERT INTO R7_EmailPhone(emp_email, emp_phone_num)
VALUES('jack@gmail.com', 2365838384)

-- R8 Employer Number and Email

INSERT INTO R8_EmployeeNumEmail(employee_num, emp_email)
VALUES(1111, 'bill@gmail.com')

INSERT INTO R8_EmployeeNumEmail(employee_num, emp_email)
VALUES(2222, 'steve@gmail.com')

INSERT INTO R8_EmployeeNumEmail(employee_num, emp_email)
VALUES(3333, 'Elon@gmail.com')

INSERT INTO R8_EmployeeNumEmail(employee_num, emp_email)
VALUES(4444, 'Jeff@gmail.com')

INSERT INTO R8_EmployeeNumEmail(employee_num, emp_email)
VALUES(5555, 'whoLetTimCook@gmail.com')

INSERT INTO R8_EmployeeNumEmail(employee_num, emp_email)
VALUES(6666, 'jack@gmail.com')

-- Create Account

INSERT INTO CreateAccount(applicant_email, account_acc_num)
VALUES('sean@gmail.com', 28485)

INSERT INTO CreateAccount(applicant_email, account_acc_num)
VALUES('dani@gmail.com', 57838)

INSERT INTO CreateAccount(applicant_email, account_acc_num)
VALUES('aaron@gmail.com', 45123)

INSERT INTO CreateAccount(applicant_email, account_acc_num)
VALUES('gittu@gmail.com', 72444)

INSERT INTO CreateAccount(applicant_email, account_acc_num)
VALUES('yan@gmail.com', 67671)

-- Store Application

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(1, 12192000, 28485)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(2, 11301999, 57838)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(3, 3042012, 45123)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(4, 2122023, 72444)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(5, 11112011, 67671)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(6, 12192001, 28485)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(7, 11302000, 57838)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(8, 3042013, 45123)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(9, 2122024, 72444)

INSERT INTO StoreApplication(job_app_num, ApplyDate, account_acc_num)
VALUES(10, 11112012, 67671)

-- Produce Application

INSERT INTO ProduceApplication(produceApp_num, ApplyDate, produceEmail)
VALUES(11, 20232707, 'sean@gmail.com')

INSERT INTO ProduceApplication(produceApp_num, ApplyDate, produceEmail)
VALUES(12, 20232707, 'dani@gmail.com')

INSERT INTO ProduceApplication(produceApp_num, ApplyDate, produceEmail)
VALUES(13, 20232707, 'aaron@gmail.com')

INSERT INTO ProduceApplication(produceApp_num, ApplyDate, produceEmail)
VALUES(14, 20232707, 'gittu@gmail.com')

INSERT INTO ProduceApplication(produceApp_num, ApplyDate, produceEmail)
VALUES(15, 20232707, 'yan@gmail.com')

-- Cover Letter

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(1, 'Hi my name is Sean and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(2, 'Hi my name is Dani and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(3, 'Hi my name is Aaron and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(4, 'Hi my name is Gittu and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(5, 'Hi my name is Yan and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(6, 'Hi my name is Sean and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(7, 'Hi my name is Dani and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(8, 'Hi my name is Aaron and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(9, 'Hi my name is Gittu and please recruit me.')

INSERT INTO CoverLetter(job_app_num, introduction)
VALUES(10, 'Hi my name is Yan and please recruit me.')

-- Resume 

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(1, 'Sean', '50 years in Google', '2 Bachelors')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(2, 'Dani', '50 years in Microsoft', '3 Masters')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(3, 'Aaron', '50 years in Tesla', '1 Bachelor, 1 Masters')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(4, 'Gittu', '50 years in UBC', '1 Doctorate')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(5, 'Yan', '50 years in UBC', '5 Masters')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(6, 'Sean', '50 years in Google', '2 Bachelors')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(7, 'Dani', '50 years in Microsoft', '3 Masters')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(8, 'Aaron', '50 years in Tesla', '1 Bachelor, 1 Masters')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(9, 'Gittu', '50 years in UBC', '1 Doctorate')

INSERT INTO Resume(job_app_num, education, experience, resName)
VALUES(10, 'Yan', '50 years in UBC', '5 Masters')

-- Accept Deny Offer

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(1, 12122023, 'sean@gmail.com')

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(2, 12132023, 'dani@gmail.com')

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(3, 12142023, 'aaron@gmail.com')

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(4, 12152023, 'gittu@gmail.com')

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(5, 12162023, 'yan@gmail.com')

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(6, 12172023, 'gittu@gmail.com')

INSERT INTO AcceptDenyOffer(offer_employee_num, StartDate, applicant_email)
VALUES(7, 12182023, 'yan@gmail.com')

-- Draft

INSERT INTO Draft(offer_employee_num, emp_employee_num)
VALUES(11, 20232707)

INSERT INTO Draft(offer_employee_num, emp_employee_num)
VALUES(12, 20232708)

INSERT INTO Draft(offer_employee_num, emp_employee_num)
VALUES(13, 20232709)

INSERT INTO Draft(offer_employee_num, emp_employee_num)
VALUES(14, 20232710)

INSERT INTO Draft(offer_employee_num, emp_employee_num)
VALUES(15, 20232711)

-- Creates

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(1, 1111)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(2, 1234)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(3, 2222)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(4, 3333)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(5, 4444)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(6, 5555)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(7, 6666)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(8, 1111)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(9, 3333)

INSERT INTO Creates(job_referID, emp_employee_num)
VALUES(10, 3333)

-- Supervisor

INSERT INTO Supervisor(emp_employee_num, fieldProject)
VALUES(1111, 'Pop Up Store')

INSERT INTO Supervisor(emp_employee_num, fieldProject)
VALUES(2222, 'Desserts')

INSERT INTO Supervisor(emp_employee_num, fieldProject)
VALUES(3333, 'Debugging')

INSERT INTO Supervisor(emp_employee_num, fieldProject)
VALUES(4444, 'Financial Analysis')

INSERT INTO Supervisor(emp_employee_num, fieldProject)
VALUES(5555, 'Phones')

-- Hiring Manager

INSERT INTO HiringManager(emp_employee_num, department)
VALUES(1111, 'Sales')

INSERT INTO HiringManager(emp_employee_num, department)
VALUES(2222, 'Food')

INSERT INTO HiringManager(emp_employee_num, department)
VALUES(3333, 'IT')

INSERT INTO HiringManager(emp_employee_num, department)
VALUES(4444, 'Data')

INSERT INTO HiringManager(emp_employee_num, department)
VALUES(5555, 'Cellular')

-- Interview

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(12122023, 'Bill Gates', 'Sean')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(12202023, 'Bill Gates', 'Sean')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(11092023, 'Elon Musk', 'Dani')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(11202023, 'Elon Musk', 'Aaron')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(11092023, 'Jeff Bezos', 'Dani')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(11092023, 'Jeff Bezos', 'Aaron')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(12012023, 'Tim Cook', 'Gittu')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(12212023, 'Tim Cook', 'Yan')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(11042023, 'Jack Ma', 'Sean')

INSERT INTO Interview(date, interviewer, interviewee)
VALUES(11042023, 'Jack Ma', 'Yan')

-- Conducts

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(1111, 12122023, 'Bill Gates', 'Sean')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(3295, 12202023, 'Steve Jobs', 'Sean')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(1342, 11092023, 'Elon Musk', 'Dani')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(3333, 11202023, 'Jeff Bezos', 'Aaron')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(6666, 11092023, 'Jeff Bezos', 'Dani')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(8888, 11092023, 'Tim Cook', 'Aaron')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(9999, 12012023, 'Tim Cook', 'Gittu')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(6283, 12212023, 'Tim Cook', 'Yan')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(1132, 11042023, 'Jack Ma', 'Sean')

INSERT INTO Conducts(emp_employee_num, date, interviewer, interviewee)
VALUES(7166, 11042023, 'Jack Ma', 'Yan')

-- Reviews

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(1111, 2222)

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(2222, 1111)

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(3333, 4444)

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(4444, 3333)

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(5555, 5555)

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(6666, 1111)

INSERT INTO Reviews(job_app_num, emp_employee_num)
VALUES(7777, 6666)

-- JR1 Schedule & Salary

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('MTWTHF', 40534)

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('Hybrid', 49998)

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('Remote', 90615)

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('WTHFS', 62983)

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('On-Call', 10000)

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('TTH', 76526)

INSERT INTO JR1_ScheduleSalary(ShiftSchedule, Salary)
VALUES('MWF', 54219)


-- JR3 Reference ID & Number of Spots

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(1, 5)

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(2, 2)

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(3, 20)

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(4, 20)

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(5, 30)

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(6, 10)

INSERT INTO JR3_ID_SpotNum(referenceID, num_of_Spots)
VALUES(7, 15)

-- JR5 Position Name & Duties

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('Photocopying', 'Receptionist')

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('Cashier', 'Retail Worker')

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('Debug Code', 'Software Engineer')

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('Meal Prep', 'Assistant Chef')

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('Answer Calls', 'Customer Service Rep')

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('Data Analysis', 'Financial Analyst')

INSERT INTO JR5_PositionDuties(Duties, PositionName)
VALUES('SQL Queries', 'Database Intern')

-- JR7 Qualifications & Duties

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('Printing Experience', 'Photocopying')

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('POS System Experience', 'Cashier')

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('Java Experience', 'Debug Code')

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('Proficiency in Food Handling', 'Meal Prep')

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('Customer Service Experience', 'Answer Calls')

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('Data Analyst Experience', 'Data Analysis')

INSERT INTO JR7_DutyQualifications(Qualifications, Duties)
VALUES('SQL Certificate', 'SQL Queries')

-- JR9 ReferenceID & Qualifications

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(1, 'Printing Experience')

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(2, 'POS System Experience')

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(3, 'Java Experience')

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(4, 'Proficiency in Food Handling')

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(5, 'Customer Service Experience')

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(6, 'Data Analyst Experience')

INSERT INTO JR9_ID_Qualifications(ReferenceID, Qualifications)
VALUES(7, 'SQL Certificate')

-- JR10 ReferenceID & Schedule

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(1, 'MWTHF')

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(2, 'Hybrid')

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(3, 'Remote')

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(4, 'WTHFS')

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(5, 'On-Call')

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(6, 'TTH')

INSERT INTO JR10_ID_Shift(ReferenceID, ShiftSchedule)
VALUES(7, 'MWF')

-- AppliesFor

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('sean@gmail.com', 1)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('dani@gmail.com', 2)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('aaron@gmail.com', 3)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('gittu@gmail.com', 4)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('yan@gmail.com', 5)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('sean@gmail.com', 6)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('dani@gmail.com', 7)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('aaron@gmail.com', 8)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('gittu@gmail.com', 9)

INSERT INTO AppliesFor(applyEmail, applyReferenceID)
VALUES('yan@gmail.com', 10)