# Databases Project (Team 5)

This is a team project we worked on for our 7th semester Databases course in 2019-2020.<br>
Our team consists of:
- [Ilias Chanis](https://github.com/liakoyras)
- [Alexandros Karasakalidis](https://github.com/darklex55)
- [Yannis Maslaris](https://github.com/ymssa)

The tasks we had to complete for the project are as following:

## Task 1
Create the requirements for a problem that requires a database and the Entity-Relationship diagram of that database.<br>
We chose to model a healthcare company that wants to manage doctors, nurses, patients and  medical equipment, along with many possible interactions between them in various clinics. Both the requirements and the diagram are in Greek.

## Task 2
Create a relational diagram based on the previous requirements and ER diagram. Implement this database in SQL and fill the database with mock data.<br>
In order to fill the database, we created a Python script that outputs `INSERT` statements for various entities of our database.<br>

The results of the first two tasks are inside the Database directory.

## Task 3
Create a website that demonstrates some functionality of the database.<br>
We used the Bootstrap edition of the [CoreUI](https://github.com/coreui/coreui-free-bootstrap-admin-template) template for the front end.<br>
We used PHP to interact with our database in order to implement:
- A login system which helps distinguish between doctors and nurses and provide them with different management options
- Pages that list the available doctors and medication stock
- Pages that allow for the logging of treatments and equipment requests
- Pages that enable room assignment for nurses and admitting a new patient into the system

The system uses `PDO` in order to connect with the database, but has only been tested for MySQL
