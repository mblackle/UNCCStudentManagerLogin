PROJECT TITLE: UNCC Student Manager Login
PURPOSE OF PROJECT: The program shows successful connection to a database and also database manipulation 
VERSION or DATE: 11/14/2016
HOW TO START THIS PROJECT: Start this project by running the server first, then run the client files to connect to the server and start the game
AUTHORS: Michael Blackley
USER INSTRUCTIONS:
Before starting this project make sure that you have a database setup. In my example I used phpmyadmin as a database but I'm sure any database will do. 
Make a database and label it 'university_schema'. Inside the database make 4 tables including 'course, department, reg_courses, users'.
For the table course enter columns 'crs_ID, crs_code, crs_title, crs_credits, dep_id, crs_description'
      *crs_ID:  type: int(11)   Null: no    Extra: AUTO_INCREMENT   primary key
      *crs_code:  type: char(10)  Null: no  
      *crs_title: type: varchar(100)   Null: no
      *crs_credits: type: tinyint(4)  Null: no
      * dep_id   type: int(11)  Null: no
      * crs_description:  type: varchar(255)  Null: no
      
For the table department enter columns 'departmentID, departmentName'
      *deparmentID:  type:int(11)   Null: no   Extra: AUTO_INCREMENT   primary key
      *departmentName  type: varchar(255)  Null: no
      
For the table reg_courses enter columns 'regID, crs_ID'
      *regID:   type: int(11)  Null: no  Extra: AUTO_INCREMENT  primary key
      *crs_ID:  type: int(11)  Null: no
      
For the table users enter columns 'userID, userName, email, password, firstName, lastName, role, deptID, gender'
      *userID  type:int(11)  Null: no  Extra: AUTO_INCREMENT  primary key
      *userName  type:varchar(100)  Null: no  foreign key
      *email  type: varchar(100)  Null: no  foreign key
      *password type: varchar(100)  Null: yes
      *firstName  type: varchar(100)  Null: no
      *lastName type: varchar(100)  Null: no
      *role type: enum('student','manager')  Null: no
      *deptID  type: int(11)  Null: yes 
      *gender type: enum('Male', 'Female', 'Other',")  Null: yes
      
      
After successfully making this database and changing the file database.php to be set up for your computer/database 
the code should run
