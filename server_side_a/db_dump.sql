CREATE DATABASE server_side_a;
USE server_side_a;
create table categories
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
) collate = utf8mb4_unicode_ci;

create table contacts
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    email      varchar(255) not null,
    message    text         not null,
    created_at timestamp    null,
    updated_at timestamp    null
) collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
) collate = utf8mb4_unicode_ci;

create table photos
(
    id          bigint unsigned auto_increment
        primary key,
    image_path  varchar(255)    not null,
    category_id bigint unsigned null,
    created_at  timestamp       null,
    updated_at  timestamp       null
) collate = utf8mb4_unicode_ci;

create table posts
(
    id           bigint unsigned auto_increment
        primary key,
    title        varchar(255)                                not null,
    image_path   varchar(255)                                not null,
    content      text                                        not null,
    status       enum ('Draft', 'Published') default 'Draft' not null,
    published_at datetime                                    null,
    category_id  bigint unsigned                             null,
    created_at   timestamp                                   null,
    updated_at   timestamp                                   null
) collate = utf8mb4_unicode_ci;

create table users
(
    id         bigint unsigned auto_increment
        primary key,
    username   varchar(255) not null,
    password   varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null
) collate = utf8mb4_unicode_ci;

