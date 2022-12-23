CREATE TABLE IF NOT EXISTS users (
    `id` INT AUTO_INCREMENT,
    `firstname` VARCHAR(100) NOT NULL,
    `lastname` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` TEXT NOT NULL,
    `dateJoined` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `dateDeparted` DATETIME,
    `role` ENUM("manager", "hr", "staff") NOT NULL,
    `status` ENUM("active", "on-leave", "departed") NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY (email)
);

CREATE TABLE IF NOT EXISTS requests (
    `id` INT AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `justification` TEXT NOT NULL,
    `status` ENUM("open", "redirected", "accepted", "rejected") DEFAULT "open" NOT NULL,
    `requesterId` INT NOT NULL,
    `createdAt` DATETIME DEFAULT CURRENT_TIMESTAMP,
    `resolvedAt` DATETIME,
    PRIMARY KEY (id),
    FOREIGN KEY (requesterId) REFERENCES users(id)
);

INSERT INTO users (`firstname`, `lastname`, `email`, `password`, `role`, `status`) VALUES ("John", "Doe", "manager@outliers.com", SHA("password"), "manager", "active");
INSERT INTO users (`firstname`, `lastname`, `email`, `password`, `role`, `status`) VALUES ("Jane", "Doe", "hr_manager@outliers.com", SHA("password"), "hr", "active");
INSERT INTO users (`firstname`, `lastname`, `email`, `password`, `role`, `status`) VALUES ("Janet", "Doe", "employee_manager@outliers.com", SHA("password"), "staff", "active");
