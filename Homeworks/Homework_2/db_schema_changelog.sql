CREATE DATABASE IF NOT EXISTS `62162_Diana_Georgieva` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `62162_Diana_Georgieva`;

CREATE TABLE candidate (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(20) NOT NULL,
    lastname VARCHAR(25) NOT NULL,
    course INT NOT NULL,
    speciality VARCHAR(50) NOT NULL,
    faculty_number INT NOT NULL,
    course_group INT NOT NULL,
    date_of_birth DATE NOT NULL,
    zodiac_sign  enum('SAGITTARIUS','CAPRICORN', 'AQUARIUS','PISCES','ARIES','TAURUS','GEMINI','CANCER','LEO','VIRGO','LIBRA','SCORPIO') NOT NULL,
    social_link VARCHAR(255),
    photo VARCHAR(50) NOT NULL,
    motivation VARCHAR(1024) NOT NULL
);
