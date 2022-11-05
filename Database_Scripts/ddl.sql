create database if not exists dr20190162;

use dr20190162; /* Switch to db context */

create table if not exists movies
(
    id         bigint auto_increment
        primary key,
    name 	    varchar(50) not null,
    year	    integer(4),
    description varchar(255),
    constraint movies_id_uindex
        unique (id)
);

create table if not exists reviews
(
    id           bigint auto_increment
        primary key,
    text varchar(255) not null,
    movie_id bigint not null,
    Rating int(2) not null,
    constraint reviews_id_uindex
        unique (id),
    constraint reviews_movie_id_fk
        foreign key (movie_id) references movies (id)
);