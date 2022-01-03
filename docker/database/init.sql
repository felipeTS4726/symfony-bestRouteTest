CREATE TABLE `Countries` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`countryName` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
  UNIQUE INDEX `countryName` (`countryName`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

CREATE TABLE `Cities` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`cityName` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`countryId` INT(11) NOT NULL,
	`added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
  FOREIGN KEY (countryId)
        REFERENCES Countries(id)
        ON DELETE CASCADE,
	UNIQUE INDEX `cityName` (`cityName`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;


CREATE TABLE `Airports` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
  `airportName` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`cityId` INT(11) NOT NULL,
	`countryId` INT(11) NOT NULL,
	`added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`),
  FOREIGN KEY (countryId)
        REFERENCES Countries(id)
        ON DELETE CASCADE,
  FOREIGN KEY (cityId)
        REFERENCES Cities(id)
        ON DELETE CASCADE
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;


CREATE TABLE `Routes` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
  `origin` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`destiny` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
	`added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB;

INSERT INTO Countries (id, countryName) VALUES (1, 'Portugal');
INSERT INTO Countries (id, countryName) VALUES (2, 'Ireland');
INSERT INTO Countries (id, countryName) VALUES (3, 'England');
INSERT INTO Countries (id, countryName) VALUES (4, 'France');
INSERT INTO Countries (id, countryName) VALUES (5, 'Spain');
INSERT INTO Countries (id, countryName) VALUES (6, 'Sweden');
INSERT INTO Countries (id, countryName) VALUES (7, 'Germany');

INSERT INTO Cities (cityName, countryId) VALUES ('Oporto', 1);
INSERT INTO Cities (cityName, countryId) VALUES ('Lisbon', 1);
INSERT INTO Cities (cityName, countryId) VALUES ('London', 3);
INSERT INTO Cities (cityName, countryId) VALUES ('Manchester', 3);
INSERT INTO Cities (cityName, countryId) VALUES ('Dublin', 2);
INSERT INTO Cities (cityName, countryId) VALUES ('Belfast', 2);
INSERT INTO Cities (cityName, countryId) VALUES ('Paris', 4);
INSERT INTO Cities (cityName, countryId) VALUES ('Nice', 4);
INSERT INTO Cities (cityName, countryId) VALUES ('Madrid', 5);
INSERT INTO Cities (cityName, countryId) VALUES ('Barcelona', 5);
INSERT INTO Cities (cityName, countryId) VALUES ('Oslo', 6);
INSERT INTO Cities (cityName, countryId) VALUES ('Berlin', 7);
INSERT INTO Cities (cityName, countryId) VALUES ('Frankfurt', 7);


INSERT INTO Airports (airportName, cityId, countryId) VALUES ('a', 1, 1);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('b', 2, 1);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('c', 3, 3);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('d', 4, 3);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('e', 5, 2);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('f', 6, 2);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('g', 7, 4);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('h', 8, 4);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('i', 9, 5);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('j', 11, 6);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('k', 12, 7);
INSERT INTO Airports (airportName, cityId, countryId) VALUES ('l', 13, 7);


INSERT INTO Routes (origin, destiny) VALUES ('a', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('a', 'g');
INSERT INTO Routes (origin, destiny) VALUES ('a', 'l');
INSERT INTO Routes (origin, destiny) VALUES ('a', 'j');
INSERT INTO Routes (origin, destiny) VALUES ('b', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('b', 'h');
INSERT INTO Routes (origin, destiny) VALUES ('b', 'd');
INSERT INTO Routes (origin, destiny) VALUES ('b', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('b', 'l');
INSERT INTO Routes (origin, destiny) VALUES ('b', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('c', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('c', 'e');
INSERT INTO Routes (origin, destiny) VALUES ('c', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('c', 'i');
INSERT INTO Routes (origin, destiny) VALUES ('c', 'j');
INSERT INTO Routes (origin, destiny) VALUES ('d', 'b');
INSERT INTO Routes (origin, destiny) VALUES ('d', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('d', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('d', 'h');
INSERT INTO Routes (origin, destiny) VALUES ('d', 'j');
INSERT INTO Routes (origin, destiny) VALUES ('d', 'l');
INSERT INTO Routes (origin, destiny) VALUES ('e', 'l');
INSERT INTO Routes (origin, destiny) VALUES ('e', 'd');
INSERT INTO Routes (origin, destiny) VALUES ('e', 'k');
INSERT INTO Routes (origin, destiny) VALUES ('e', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('e', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('f', 'h');
INSERT INTO Routes (origin, destiny) VALUES ('f', 'e');
INSERT INTO Routes (origin, destiny) VALUES ('f', 'd');
INSERT INTO Routes (origin, destiny) VALUES ('f', 'i');
INSERT INTO Routes (origin, destiny) VALUES ('f', 'l');
INSERT INTO Routes (origin, destiny) VALUES ('f', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('g', 'b');
INSERT INTO Routes (origin, destiny) VALUES ('g', 'd');
INSERT INTO Routes (origin, destiny) VALUES ('g', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('g', 'h');
INSERT INTO Routes (origin, destiny) VALUES ('h', 'i');
INSERT INTO Routes (origin, destiny) VALUES ('h', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('h', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('h', 'e');
INSERT INTO Routes (origin, destiny) VALUES ('h', 'g');
INSERT INTO Routes (origin, destiny) VALUES ('i', 'b');
INSERT INTO Routes (origin, destiny) VALUES ('i', 'e');
INSERT INTO Routes (origin, destiny) VALUES ('i', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('i', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('i', 'b');
INSERT INTO Routes (origin, destiny) VALUES ('i', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('j', 'd');
INSERT INTO Routes (origin, destiny) VALUES ('j', 'e');
INSERT INTO Routes (origin, destiny) VALUES ('j', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('j', 'g');
INSERT INTO Routes (origin, destiny) VALUES ('j', 'h');
INSERT INTO Routes (origin, destiny) VALUES ('j', 'i');
INSERT INTO Routes (origin, destiny) VALUES ('k', 'j');
INSERT INTO Routes (origin, destiny) VALUES ('k', 'l');
INSERT INTO Routes (origin, destiny) VALUES ('k', 'a');
INSERT INTO Routes (origin, destiny) VALUES ('k', 'b');
INSERT INTO Routes (origin, destiny) VALUES ('k', 'c');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'd');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'e');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'f');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'g');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'h');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'i');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'j');
INSERT INTO Routes (origin, destiny) VALUES ('l', 'k');
