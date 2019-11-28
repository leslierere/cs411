### Requirements on Stage 4

#### Basic Functionality:

- Show how to insert records to the database.

  **addclass.php, adduser.php**
  
  Insert class a student wanna take
  
- Show one query that searches the database, and display the returned records in your application.

  **intendedclass.php**

  Example: the average GPA of the class in the past, by diff teacher? by year?

- Show how to update records.

  **updateuser.php**

  Example: update majors

- Show how to delete records.

  **delclass.php**

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



#### For dummy data, stored in neo4j

* based on the classes taken by student, we can recommend the other classes that students taking these classes also take (thus that we can use neo4j to store information about the classes taken by students)



#### info on ratemyprofessor

* Overall quality-

* Tags of the teacher

* Would take again

* LEVEL OF DIFFICULTY

  

#### Some ideas

* for optional courses, based on the usefulness in career

* pull out all the courses by the same professor

  

