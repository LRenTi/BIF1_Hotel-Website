Create database hotel

create table ACCOUNTS (
    ID int not null AUTO_INCREMENT primary key,
    USERNAME varchar(255) not null UNIQUE,
    PASSWORD varchar(255) not null,
    ANREDE varchar(255),
    VORNAME varchar(255),
    NACHNAME varchar(255),
    EMAIL varchar(255),
    TELEFON varchar(16)
)

create table NEWS (
    ID int not null AUTO_INCREMENT primary key,
    TITLE varchar(255) not null,
    TEXT varchar(255) not null,
    IMAGE varchar(255 not null),
    DATE date not null
)