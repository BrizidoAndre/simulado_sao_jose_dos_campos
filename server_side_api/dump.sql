CREATE DATABASE gonzaga_barber;
USE gonzaga_barber;
create table customers
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint customers_name_unique
        unique (name)
)
    collate = utf8mb4_unicode_ci;

create table employees
(
    id         bigint unsigned auto_increment
        primary key,
    name       varchar(255) not null,
    created_at timestamp    null,
    updated_at timestamp    null,
    constraint employees_name_unique
        unique (name)
)
    collate = utf8mb4_unicode_ci;

create table migrations
(
    id        int unsigned auto_increment
        primary key,
    migration varchar(255) not null,
    batch     int          not null
)
    collate = utf8mb4_unicode_ci;

create table plans
(
    id                  bigint unsigned auto_increment
        primary key,
    name                varchar(255)   not null,
    price               int            not null,
    monthly_usage_limit int            not null,
    next_transaction    int default 15 not null,
    created_at          timestamp      null,
    updated_at          timestamp      null
)
    collate = utf8mb4_unicode_ci;

create table subscriptions
(
    id          bigint unsigned auto_increment
        primary key,
    customer_id bigint unsigned not null,
    plan_id     bigint unsigned not null,
    start_date  date            not null,
    created_at  timestamp       null,
    updated_at  timestamp       null
)
    collate = utf8mb4_unicode_ci;

create table transactions
(
    id               bigint unsigned auto_increment
        primary key,
    subscription_id  bigint unsigned                                         not null,
    amount           int                                                     not null,
    transaction_date date                                                    not null,
    status           enum ('Paid', 'Pending', 'Not Apply') default 'Pending' not null,
    worker_id        bigint unsigned                                         null,
    usage_count      int                                                     not null,
    description      text                                                    null,
    created_at       timestamp                                               null,
    updated_at       timestamp                                               null
)
    collate = utf8mb4_unicode_ci;

create table users
(
    id         bigint unsigned auto_increment
        primary key,
    username   varchar(255) not null,
    password   varchar(255) not null,
    token      varchar(255) null,
    created_at timestamp    null,
    updated_at timestamp    null
)
    collate = utf8mb4_unicode_ci;

