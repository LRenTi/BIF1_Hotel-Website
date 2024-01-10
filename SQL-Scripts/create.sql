Create database hotel

create table ACCOUNTS (
    ID int not null AUTO_INCREMENT primary key,
    USERNAME varchar(255) not null UNIQUE,
    PASSWORD varchar(255) not null,
    ANREDE varchar(255),
    VORNAME varchar(255),
    NACHNAME varchar(255),
    EMAIL varchar(255),
    TELEFON varchar(16),
    ROLE int not null -- -1 = gesperrt, 0 = Gast, 1 = Mitarbeiter, 2 = Admin
)

create table NEWS (
    ID int not null AUTO_INCREMENT primary key,
    TITLE varchar(255) not null,
    TEXT varchar(2048) not null,
    IMAGE varchar(255) not null,
    DATE date not null
)

create table ROOMS (
    ID int not null AUTO_INCREMENT primary key,
    NAME varchar(255) not null,
    TYPE int not null, -- 1 = Einzelzimmer, 2 = Doppelzimmer, 3 = Suite
    PRICE int not null,
    IMAGE varchar(255) not null
)

INSERT INTO ROOMS (NAME, TYPE, PRICE, IMAGE) VALUES ('Einzelzimmer', 1, 50, "uploads/rooms/HotelRoom1.jpg");
INSERT INTO ROOMS (NAME, TYPE, PRICE, IMAGE) VALUES ('Doppelzimmer', 2, 80, "uploads/rooms/HotelRoom2.jpg");
INSERT INTO ROOMS (NAME, TYPE, PRICE, IMAGE) VALUES ('Suite', 3, 120, "uploads/rooms/HotelRoom3.png");

create table BOOKINGS (
    ID int not null AUTO_INCREMENT primary key,
    ROOM_ID int not null,
    USER_ID int not null,
    START_DATE date not null,
    END_DATE date not null,
    STATUS int not null, -- 0 = neu, 1 = bestätigt, -1 = storniert
    TIMESTAMP timestamp not null,
    BREAKFAST boolean not null,
    PARKING boolean not null,
    PETS boolean not null,
    TOTAL_PRICE int not null,
    FOREIGN KEY (ROOM_ID) REFERENCES ROOMS(ID),
    FOREIGN KEY (USER_ID) REFERENCES ACCOUNTS(ID)
)