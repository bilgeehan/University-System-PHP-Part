create table BuildClass (
buildingName VarChar(20) not null,
roomNumber int not null,
check(roomNumber <= 25 and roomNumber>=0) ,
capacity numeric(2) not null,
primary key (buildingName,roomNumber)
);

create table Department (
dName VarChar(20) not null,
budget numeric(10),
headSsn numeric(11),
buildingName VarChar(20),
primary key (dName),
foreign key (buildingName) references BuildClass(buildingName)
);

create table Curricula (
currCode char(8),
gradOrUGrad char(1),
dName VarChar(20) not null,
primary key (currCode,dName),
foreign key (dName) references Department(dName)
);

create table Instructor (
ssn numeric(11),
iName VarChar(20),
rank varChar(30),			-- size arttırıldı		
baseSalary numeric(5),
extraSalary numeric(5),
dName VarChar(20) not null,
primary key (ssn),
foreign key (dName) references Department(dName)
);

create table Project (
leadSsn numeric(11) not null,
prName VarChar(50) ,		-- size arttırdım
budget numeric(6),
startDate date,
endDate  date,
subject VarChar(100),		-- size arttırdım
contrDName VarChar(20) not null,
primary key(leadSsn,prName),
foreign key (leadSsn) references Instructor(ssn),
foreign key (contrDName) references Department(dName) 
);

create table InstrInProjects (
PrjleadSsn numeric(11),
prName VarChar(20),
issn numeric(11),
workingHours numeric(5,1),
primary key (PrjleadSsn,prName,issn),
foreign key (PrjleadSsn,prName) references Project(leadSsn,prName),
foreign key (issn) references Instructor(ssn)
);

create table Student (  
sssn numeric(11),
gradorUgrad Char(1),
advisorSsn numeric(11) ,
currCode char(8),
dName VarChar(20) not null,
studentId int,
check(studentId <=1000),
Sname VarChar(20),
primary key (sssn),
foreign key (advisorSsn) references Instructor(ssn),
foreign key (currCode) references Curricula(currCode),
foreign key (dName) references Curricula(dName)
);

create table gradstudent (
sssn numeric(11) primary key,
advisorSsn numeric(11),
foreign key (advisorSsn) references Instructor(ssn),
foreign key (sssn) references Student(sssn)
);

create table prevDegrees (
college VarChar(20),
degree numeric(3),
year numeric(49),
gradssn numeric(11),
primary key (college,degree,year,gradssn),
foreign key (gradssn) references gradstudent(sssn)
);

create table emails (                 
sssn numeric(11),
email VarChar(20),
primary key (sssn),
foreign key (sssn) references Student(sssn)
);


create table course (
ects int,
check(ects <=27 and ects>=0),                 
courseName VarChar(40) ,                    -- Size'ı yükselttim
courseCode Varchar(8) not null,                     
numHours int,
check((numHours) <=20 and (numHours) >=0),
preReqCourseCode VarChar(8),
primary key (courseCode),
foreign key (preReqCourseCode) references course(courseCode)
);

create table section (
semester VarChar(6),
courseCode VarChar(8),                     
year numeric(4),
sectionId int ,         
check(sectionId <=10 and sectionId >0),
quota numeric(2),
issn numeric(11),
primary key (semester,courseCode,year,sectionId,issn),
foreign key (issn) references Instructor(ssn),
foreign key (courseCode) references course(courseCode)
);


create table curriculaCourses (
courseCode Varchar(8) not null,              
dName VarChar(20),
currCode Char(8) not null,
primary key (courseCode,dName,currCode),
foreign key (courseCode) references Course(courseCode),
foreign key (dName) references Curricula(dName),
foreign key (currCode) references Curricula(currCode)
);

create table GradsInProjects (
prjleadSsn numeric(11),
prName VarChar(20),
gradsSsn numeric(11),
workingHours numeric(3,2),  -- günlük düşündük.                      
primary key (prjleadSsn, prName, gradsSsn),
foreign key (prjleadSsn,prName) references Project(leadSsn,prName),
foreign key (gradsSsn) references gradstudent(sSsn)
);

create table TimeSlot ( 
day VarChar(10),
hour numeric(2),    
primary key (day,hour)
);

create table enrollment (   
sssn numeric(11) not null,
grade char(2),
semester VarChar(6),
courseCode Varchar(8),                      
year numeric(4),
sectionId int not null,
check(sectionId <=10 and sectionId >0),
issn numeric(11),
buildingName VarChar(20),
roomNumber int,
check(roomNumber<=25 and roomNumber>=0),
hour numeric(2),                      
day VarChar(10),
primary key (sssn,semester,coursecode,year,sectionId,issn),
foreign key (sssn) references Student(sssn),
foreign key (semester,courseCode,year,sectionId) references section(semester,courseCode,year,sectionId),
foreign key (day,hour) references TimeSlot(day,hour),
foreign key (issn) references Instructor(ssn),
foreign key (buildingName,roomNumber) references BuildClass(buildingName,roomNumber)
);

alter table Department 
add constraint fk1 
foreign key(headSsn) references Instructor(ssn);

-- alter table Project 
-- add trigger tg1
-- Check(endDate>= Startdate);


