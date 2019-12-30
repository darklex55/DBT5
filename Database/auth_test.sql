/* In order to quickly test the authentication system from
an empty database, use the following SQL.
The email is nurse@email.com or doctor@email.com and the 
password is 'password' for both accounts.
The output of api/test.php should be: 
user_id: AK123456, clinic_id: 1, access_level: 2 (nurse) 
user_id: AK234567, clinic_id: 1, access_level: 1 (doctor) */

INSERT INTO `clinics` (`id`, `name`, `addr_city`, `addr_street`, `addr_number`, `number_floors`, `number_employees`, `number_rooms`, `number_patients`) VALUES (NULL, 'Agios FIlaretos', 'Xanthi', 'Platonos', '50', '7', '100', '50', '150');

INSERT INTO `departments` (`name`, `number_employees`, `clinic_id`) VALUES ('Nursing', '50', '1');
INSERT INTO `departments` (`name`, `number_employees`, `clinic_id`) VALUES ('Cardiology', '50', '1');

INSERT INTO `employees` (`id`, `name`, `surname`, `amka`, `afm`, `birth_date`, `gender`, `telephone`, `email`, `addr_city`, `addr_street`, `addr_number`, `specialty`, `hire_date`, `salary`, `hours_per_week`, `vacation_days_left`, `department_name`, `dept_clinic_id`, `password`) VALUES
('AK123456', 'John', 'Doe', 12345678901, 1234567890, '2019-12-09', 'm', '+30 1234567890', 'nurse@email.com', 'Xanthi', 'Dimokritoy', '38', 'Nurse', '2019-12-26', 60000, 50, 0, 'Nursing', 1, '$2y$10$OcZH82cT2w41RHDwiGy4jeUjGnaWEfOtsrJq7iM9zQ.ukMEWVuu4y');
INSERT INTO `employees` (`id`, `name`, `surname`, `amka`, `afm`, `birth_date`, `gender`, `telephone`, `email`, `addr_city`, `addr_street`, `addr_number`, `specialty`, `hire_date`, `salary`, `hours_per_week`, `vacation_days_left`, `department_name`, `dept_clinic_id`, `password`) VALUES
('AK234567', 'Jane', 'Doe', 12345678910, 1234567891, '2010-12-09', 'f', '+30 1234567891', 'doctor@email.com', 'Xanthi', 'Dimokritoy', '38', 'Cardiosurgeon', '2019-12-26', 110000, 50, 0, 'Cardiology', 1, '$2y$10$OcZH82cT2w41RHDwiGy4jeUjGnaWEfOtsrJq7iM9zQ.ukMEWVuu4y');
