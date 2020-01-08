/* This will create an empty database if it doesn't
already exist. */

CREATE DATABASE IF NOT EXISTS lab1920omada5_website;
USE lab1920omada5_website;


CREATE TABLE `clinics` (
 `id` int(4) NOT NULL AUTO_INCREMENT,
 `name` varchar(50) NOT NULL,
 `addr_city` varchar(50) NOT NULL,
 `addr_street` varchar(50) NOT NULL,
 `addr_number` varchar(5) NOT NULL,
 `number_floors` int(2) NOT NULL,
 `number_employees` int(3) NOT NULL,
 `number_rooms` int(3) NOT NULL,
 `number_patients` int(4) NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `departments` (
 `name` varchar(30) NOT NULL,
 `number_employees` int(3) NOT NULL,
 `clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`name`,`clinic_id`),
 FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`)
);

CREATE TABLE `employees` (
 `id` varchar(8) NOT NULL,
 `name` varchar(50) NOT NULL,
 `surname` varchar(50) NOT NULL,
 `amka` bigint(11) NOT NULL,
 `afm` bigint(10) NOT NULL,
 `birth_date` date NOT NULL,
 `gender` varchar(1) NOT NULL,
 `telephone` varchar(15) NOT NULL,
 `email` varchar(100) NOT NULL,
 `addr_city` varchar(50) NOT NULL,
 `addr_street` varchar(50) NOT NULL,
 `addr_number` varchar(50) NOT NULL,
 `specialty` varchar(50) NOT NULL,
 `hire_date` date NOT NULL,
 `salary` float NOT NULL,
 `hours_per_week` int(2) NOT NULL,
 `vacation_days_left` int(2) NOT NULL,
 `department_name` varchar(30) NOT NULL,
 `dept_clinic_id` int(4) NOT NULL,
 `password` varchar(70) NOT NULL,
 PRIMARY KEY (`id`),
 FOREIGN KEY (`department_name`, `dept_clinic_id`) REFERENCES `departments` (`name`, `clinic_id`)
);

CREATE TABLE `rooms` (
 `number` int(5) NOT NULL,
 `floor` int(2) NOT NULL,
 `capacity` int(2) NOT NULL,
 `number_patients` int(2) NOT NULL,
 `price` int(3) NOT NULL,
 `clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`number`,`clinic_id`),
 FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`) 
);

CREATE TABLE `responsibles` (
 `nurse_id` varchar(8) NOT NULL,
 `room_clinic_id` int(4) NOT NULL,
 `room_number` int(5) NOT NULL,
 PRIMARY KEY (`nurse_id`,`room_clinic_id`, `room_number`),
 FOREIGN KEY (`nurse_id`) REFERENCES `employees` (`id`),
 FOREIGN KEY (`room_clinic_id`, `room_number`) REFERENCES `rooms` (`clinic_id`, `number`)
);

CREATE TABLE `patients` (
 `patient_code` int(10) NOT NULL,
 `id` varchar(8),
 `name` varchar(50),
 `surname` varchar(50),
 `amka` bigint(11),
 `afm` bigint(10),
 `birth_date` date,
 `gender` varchar(1),
 `telephone` varchar(15),
 `addr_city` varchar(50),
 `addr_street` varchar(50),
 `addr_number` varchar(50),
 `admission_date` date NOT NULL,
 `discharge_date` date,
 `admission_reason` text NOT NULL,
 `current_fee` float NOT NULL,
 `blood_type` varchar(3),
 `patient_room` int(5),
 `patient_clinic_id` int(4),
 `attended_by` varchar(8) NOT NULL,
 PRIMARY KEY (`patient_code`),
 FOREIGN KEY (`patient_room`, `patient_clinic_id`) REFERENCES `rooms` (`number`, `clinic_id`),
 FOREIGN KEY (`attended_by`) REFERENCES `employees` (`id`)
);

CREATE TABLE `emergency_contacts` (
 `name` varchar(50) NOT NULL,
 `surname` varchar(50) NOT NULL,
 `telephone` varchar(15),
 `relationship` varchar(30),
 `cont_patient_code` int(10) NOT NULL,
 PRIMARY KEY (`cont_patient_code`,`name`,`surname`),
 FOREIGN KEY (`cont_patient_code`) REFERENCES `patients` (`patient_code`)
);

CREATE TABLE `medications` (
 `name` varchar(50) NOT NULL,
 `type` varchar(100) NOT NULL,
 `active_substance` varchar(200) NOT NULL,
 `quantity` int(3) NOT NULL,
 `price` int(5),
 `clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`clinic_id`,`name`),
 FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`)
);

CREATE TABLE `equipment` (
 `name` varchar(15) NOT NULL,
 `type` varchar(40) NOT NULL,
 `state` boolean NOT NULL,
 `clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`name`, `clinic_id`),
 FOREIGN KEY (`clinic_id`) REFERENCES `clinics` (`id`)
);

CREATE TABLE `occupied` (
 `occupied_from` datetime NOT NULL,
 `occupied_until` datetime NOT NULL,
 `equipment_name` varchar(15) NOT NULL,
 `equipment_clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`equipment_name`, `equipment_clinic_id`, `occupied_from`, `occupied_until`),
 FOREIGN KEY (`equipment_name`, `equipment_clinic_id`) REFERENCES `equipment` (`name`, `clinic_id`)
);

CREATE TABLE `equipment_requests` (
 `requested_from` datetime NOT NULL,
 `requested_until` datetime NOT NULL,
 `requesting_doctor_id` varchar(8) NOT NULL,
 `requested_equipment_name` varchar(15) NOT NULL,
 `requested_equipment_clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`requesting_doctor_id`, `requested_equipment_name`, `requested_equipment_clinic_id`, `requested_from`, `requested_until`),
 FOREIGN KEY (`requesting_doctor_id`) REFERENCES `employees` (`id`),
 FOREIGN KEY (`requested_equipment_name`, `requested_equipment_clinic_id`) REFERENCES `equipment` (`name`, `clinic_id`)
);

CREATE TABLE `treats` (
 `date` datetime NOT NULL,
 `diagnosis` text NOT NULL,
 `treatment` text NOT NULL,
 `treating_doctor_id` varchar(8) NOT NULL,
 `treated_patient_code` int(10) NOT NULL,
 `treating_medication_name` varchar(50) NOT NULL,
 `treating_medication_clinic_id` int(4) NOT NULL,
 PRIMARY KEY (`date`, `treating_medication_clinic_id`,`treating_medication_name`,`treated_patient_code`,`treating_doctor_id`),
 FOREIGN KEY (`treating_doctor_id`) REFERENCES `employees` (`id`),
 FOREIGN KEY (`treated_patient_code`) REFERENCES `patients` (`patient_code`),
 FOREIGN KEY (`treating_medication_clinic_id`, `treating_medication_name`) REFERENCES `medications` (`clinic_id`, `name`)
);

CREATE TABLE `tokens` (
  `user_id` varchar(8) NOT NULL,
  `token` char(64) NOT NULL,
  `valid_until` bigint(11) NOT NULL,
  `last_use` bigint(11) NOT NULL,
  PRIMARY KEY (`user_id`, `token`),
  FOREIGN KEY (`user_id`) REFERENCES `employees` (`id`)
);

commit;

