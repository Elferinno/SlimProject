# ALTER TABLE user_sector DROP FOREIGN KEY user_sector_ibfk_1;
# ALTER TABLE user_sector DROP FOREIGN KEY user_sector_ibfk_2;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS sectors;
DROP TABLE IF EXISTS user_sector;

CREATE TABLE users (ID INTEGER PRIMARY KEY AUTO_INCREMENT, Name VARCHAR(25));

CREATE TABLE sectors (ID INTEGER PRIMARY KEY AUTO_INCREMENT, Title VARCHAR(100));

CREATE TABLE user_sector (
                             ID INTEGER PRIMARY KEY AUTO_INCREMENT,
                             User_id INTEGER,
                             Sector_id INTEGER,
                             AgreeTerms BOOLEAN,

                             FOREIGN KEY (User_id) REFERENCES users(ID), FOREIGN KEY (Sector_id) REFERENCES sectors(ID));


INSERT INTO users VALUES (1, 'erik');
INSERT INTO users VALUES (2, 'kire');

# INSERT INTO user_sector VALUES (null, 1, 1, TRUE);
# INSERT INTO user_sector VALUES (null, 1, 2, TRUE);
# INSERT INTO user_sector VALUES (null, 2, 1, TRUE);

INSERT INTO sectors (Title) VALUES ('Manufacturing');
INSERT INTO sectors (Title) VALUES ('Construction materials');
INSERT INTO sectors (Title) VALUES ('Electronics and Optics');
INSERT INTO sectors (Title) VALUES ('Food and Beverage');
INSERT INTO sectors (Title) VALUES ('Bakery and confectionery products');
INSERT INTO sectors (Title) VALUES ('Beverages');
INSERT INTO sectors (Title) VALUES ('Fish and fish products');
INSERT INTO sectors (Title) VALUES ('Meat and meat products');
INSERT INTO sectors (Title) VALUES ('Milk and dairy products');
INSERT INTO sectors (Title) VALUES ('Sweets and snack food');
INSERT INTO sectors (Title) VALUES ('Furniture');
INSERT INTO sectors (Title) VALUES ('Bathroom/sauna');
INSERT INTO sectors (Title) VALUES ('Bedroom');
INSERT INTO sectors (Title) VALUES ('Children’s room');
INSERT INTO sectors (Title) VALUES ('Kitchen');
INSERT INTO sectors (Title) VALUES ('Living room');
INSERT INTO sectors (Title) VALUES ('Office');
INSERT INTO sectors (Title) VALUES ('Other (Furniture)');
INSERT INTO sectors (Title) VALUES ('Outdoor');
INSERT INTO sectors (Title) VALUES ('Project furniture');
INSERT INTO sectors (Title) VALUES ('Machinery');
INSERT INTO sectors (Title) VALUES ('Machinery components');
INSERT INTO sectors (Title) VALUES ('Machinery equipment/tools');
INSERT INTO sectors (Title) VALUES ('Manufacture of machinery');
INSERT INTO sectors (Title) VALUES ('Maritime');
INSERT INTO sectors (Title) VALUES ('Aluminium and steel workboats');
INSERT INTO sectors (Title) VALUES ('Boat/Yacht building');
INSERT INTO sectors (Title) VALUES ('Ship repair and conversion');
INSERT INTO sectors (Title) VALUES ('Metal structures');
INSERT INTO sectors (Title) VALUES ('Repair and maintenance service');
INSERT INTO sectors (Title) VALUES ('Metalworking');
INSERT INTO sectors (Title) VALUES ('Construction of metal structures');
INSERT INTO sectors (Title) VALUES ('Houses and buildings');
INSERT INTO sectors (Title) VALUES ('Metal products');
INSERT INTO sectors (Title) VALUES ('Metal works');
INSERT INTO sectors (Title) VALUES ('CNC-machining');
INSERT INTO sectors (Title) VALUES ('Forgings, Fasteners');
INSERT INTO sectors (Title) VALUES ('Gas, Plasma, Laser cutting');
INSERT INTO sectors (Title) VALUES ('MIG, TIG, Aluminum welding');
INSERT INTO sectors (Title) VALUES ('Plastic and Rubber');
INSERT INTO sectors (Title) VALUES ('Packaging');
INSERT INTO sectors (Title) VALUES ('Plastic goods');
INSERT INTO sectors (Title) VALUES ('Plastic processing technology');
INSERT INTO sectors (Title) VALUES ('Blowing');
INSERT INTO sectors (Title) VALUES ('Moulding');
INSERT INTO sectors (Title) VALUES ('Plastics welding and processing');
INSERT INTO sectors (Title) VALUES ('Plastic profiles');
INSERT INTO sectors (Title) VALUES ('Printing');
INSERT INTO sectors (Title) VALUES ('Advertising');
INSERT INTO sectors (Title) VALUES ('Book/Periodicals printing');
INSERT INTO sectors (Title) VALUES ('Labelling and packaging printing');
INSERT INTO sectors (Title) VALUES ('Textile and Clothing');
INSERT INTO sectors (Title) VALUES ('Clothing');
INSERT INTO sectors (Title) VALUES ('Textile');
INSERT INTO sectors (Title) VALUES ('Wood');
INSERT INTO sectors (Title) VALUES ('Wooden building materials');
INSERT INTO sectors (Title) VALUES ('Wooden houses');
INSERT INTO sectors (Title) VALUES ('Other');
INSERT INTO sectors (Title) VALUES ('Creative industries');
INSERT INTO sectors (Title) VALUES ('Energy technology');
INSERT INTO sectors (Title) VALUES ('Environment');
INSERT INTO sectors (Title) VALUES ('Service');
INSERT INTO sectors (Title) VALUES ('Business services');
INSERT INTO sectors (Title) VALUES ('Engineering');
INSERT INTO sectors (Title) VALUES ('Information Technology and Telecommunications');
INSERT INTO sectors (Title) VALUES ('Data processing, Web portals, E-marketing');
INSERT INTO sectors (Title) VALUES ('Programming, Consultancy');
INSERT INTO sectors (Title) VALUES ('Software, Hardware');
INSERT INTO sectors (Title) VALUES ('Telecommunications');
INSERT INTO sectors (Title) VALUES ('Tourism');
INSERT INTO sectors (Title) VALUES ('Translation services');
INSERT INTO sectors (Title) VALUES ('Transport and Logistics');
INSERT INTO sectors (Title) VALUES ('Air');
INSERT INTO sectors (Title) VALUES ('Rail');
INSERT INTO sectors (Title) VALUES ('Road');
INSERT INTO sectors (Title) VALUES ('Water');


SELECT * FROM sectors;


SELECT * FROM users;

SELECT
    u.Name,
    s.Title,
    userSector.AgreeTerms
FROM
    users u
        JOIN
    user_sector userSector ON u.ID = userSector.User_id
        JOIN
    sectors s ON userSector.Sector_id = s.ID;
