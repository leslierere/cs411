### Requirements on Stage 4

#### Basic Functionality:

- Show how to insert records to the database.-OK

  **addclass.php, adduser.php**
  
  Insert class a student wanna take
  
- Show one query that searches the database, and display the returned records in your application.-OK

  **intendedclass.php**

  Example: the average GPA of the class in the past, by diff teacher? by year?

- Show how to update records.-OK

  **updateuser.php**

  Example: update majors

- Show how to delete records.-OK

  **delclass.php** 12.4 embedded in intended class

  A table that store the classes students intend to enroll



#### Write two extra SQL queries on a new wiki page titled "SQL Queries", linked in the "Documents" section under your team's main page. These queries should be more sophisticated than the basic query in CRUD; at minimum, they should involve at least two of the following:

- join of multiple relations, just join the GPA and TeacherRank, but a new table may need be created using the data in these two tables to achieve join
- set operations, 
- aggregation via GROUP BY. like calculate average GPA of a class by different professor





### Feedback on 1101

* add up to 25 records
* how to recommend the classes for future classes ->add more features, refer what other search engines do, check the codes line by line.





#### For the data through scraping ratemyprofessor, stored in neo4j

* based on the classes a student intended to take, we can recommend the ones by specific professors with lowest level of difficulty
* based on the classes a student intended to take, we can recommend the ones by specific professors with highest level of quaility
* based on the classes a student intended to take, we can recommend the ones by specific professors with different tags, caring, hilarious 



#### For dummy data, stored in neo4j-add more dummy data

* based on the classes taken by student, we can recommend the other classes that students taking these classes also take (thus that we can use neo4j to store information about the classes taken by students)



#### To be done by Jesse:

* look up average gpa by cs411, rather than the complete name
* add dummy data in mysql



#### info on ratemyprofessor

* Overall quality-

* Tags of the teacher

* Would take again

* LEVEL OF DIFFICULTY

  

#### Some ideas

* for optional courses, based on the usefulness in career
* pull out all the courses by the same professor





- **Basic Functions**:
  1. There are some **real data** in the database: either **crawled from real websites** OR **inserted by your friends - 10 developed accounts** (not fake randomly generated values). **If you crawl data, the DB should have at least 100 records and if you are going to have user-generated data then you must have at least 25 records in your database before your final demo deadline.** Ok 
  2. Show how to insert/update/delete records to the database (repeat from the Initial Demo) ok
  3. Show how to search the database and list or print returned results. You need to show a few different interesting queries over your database. **One of the queries must involve join of multiple (at least 2) tables.** ***Haven't done yet***

- **Demo Advanced Function 1:** Give a brief overview of your advanced function and show us how it works in your project. We will mainly grade in three dimensions (usefulness, technical difficulties, and novelty), so please try to answer the following questions during the demo:**the recommended class with teachers with highest quality, connect neo4j and mysql in php, one teacher-to-many classes on neo4j, but the output we need is for each class, give teacher name with the highest rating**
  1. Why is it useful for your users?
  2. Does it use database stored procedures, functions OR triggers?
  3. Why is it technically challenging than the basic functions? How did you overcome the difficulties?
  4. Is it creative or novel with respect to other similar applications in the domain?

- **Discuss and Demo Advanced Function 2**: **courses taken by others**. Ok.

  Give a brief overview of your implementation of a No-SQL database and show us how it works in your project.

  - discuss your design decisions related to storing your app data in relational vs. non-relational databases.
  - discuss challenges related to connecting data items between the SQL and NoSQL databases. 