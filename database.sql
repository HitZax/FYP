-- active_session
CREATE TABLE `active_session` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `session_id` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL
);

-- audit_log
CREATE TABLE `audit_log` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `action` VARCHAR(255),
  `status` VARCHAR(50),
  `attempt_number` INT,
  `ip_address` VARCHAR(45),
  `user_agent` VARCHAR(255),
  `timestamp` DATETIME NOT NULL
);

-- chat
CREATE TABLE `chat` (
  `chatid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sid` INT UNSIGNED NOT NULL,
  `id` INT UNSIGNED NOT NULL
);

-- interndetail
CREATE TABLE `interndetail` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `sid` INT UNSIGNED NOT NULL,
  `startdate` DATE,
  `enddate` DATE,
  `visitdate` DATE,
  `reportdate` DATE
);

-- invitecode
CREATE TABLE `invitecode` (
  `invcode` VARCHAR(255) PRIMARY KEY
);

-- lecturer
CREATE TABLE `lecturer` (
  `lid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `lname` VARCHAR(255),
  `lemail` VARCHAR(255),
  `lroom` VARCHAR(255),
  `invcode` VARCHAR(255),
  `id` INT UNSIGNED
);

-- logbook
CREATE TABLE `logbook` (
  `lbid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `lbcreated` DATETIME,
  `sid` INT UNSIGNED,
  `lid` INT UNSIGNED
);

-- message
CREATE TABLE `message` (
  `messageid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `message` TEXT,
  `timestamp` DATETIME,
  `chatid` INT UNSIGNED,
  `id` INT UNSIGNED
);

-- program
CREATE TABLE `program` (
  `pid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `pname` VARCHAR(255),
  `pdesc` TEXT
);

-- student
CREATE TABLE `student` (
  `sid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `lid` INT UNSIGNED,
  `sname` VARCHAR(255),
  `sprogram` VARCHAR(255),
  `studentid` VARCHAR(255),
  `id` INT UNSIGNED
);

-- task
CREATE TABLE `task` (
  `tid` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `tname` VARCHAR(255),
  `tdesc` TEXT,
  `tdate` DATE,
  `remark` TEXT,
  `lbid` INT UNSIGNED,
  `tpic` VARCHAR(255)
);

-- 2fa_code
CREATE TABLE `2fa_code` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `user_id` INT UNSIGNED NOT NULL,
  `code` VARCHAR(255) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `expires_at` DATETIME NOT NULL,
  `used` TINYINT(1) DEFAULT 0
);

-- users
CREATE TABLE `users` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `fullname` VARCHAR(255),
  `email` VARCHAR(255) UNIQUE,
  `password` VARCHAR(255),
  `studentid` VARCHAR(255),
  `role` VARCHAR(50),
  `status` VARCHAR(50),
  `last2FA` DATETIME
);