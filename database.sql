CREATE DATABASE IF NOT EXISTS courss_db;
USE courss_db;

DROP TABLE IF EXISTS enrollments;
DROP TABLE IF EXISTS courses;

CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(80) NOT NULL,
    short_description VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    duration VARCHAR(50) NOT NULL,
    level_name VARCHAR(50) NOT NULL
);

CREATE TABLE enrollments (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    student_email VARCHAR(120) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    course_id INT NOT NULL,
    study_mode VARCHAR(30) NOT NULL,
    notes TEXT,
    enrollment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id) ON DELETE CASCADE
);

INSERT INTO courses (course_name, short_description, price, duration, level_name) VALUES
('CCNA', 'A networking course that covers routing, switching, IP addressing, and basic network troubleshooting.', 1200.00, '8 weeks', 'Beginner to Intermediate'),
('Security+', 'A cybersecurity foundation course covering threats, risk management, access control, and security operations.', 1050.00, '7 weeks', 'Beginner'),
('AWS P', 'A practical cloud course focused on AWS services, cloud deployment, monitoring, and basic architecture.', 2100.00, '10 weeks', 'Intermediate'),
('CCIE', 'An advanced networking course for complex enterprise infrastructure, design, and expert-level troubleshooting.', 2900.00, '14 weeks', 'Advanced'),
('ASDA', 'A data analytics course covering spreadsheets, dashboards, data cleaning, and simple business reporting.', 1400.00, '6 weeks', 'Beginner');
