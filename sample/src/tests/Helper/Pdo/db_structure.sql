create table products
(
    id          int auto_increment
        primary key,
    name        varchar(255) null,
    description varchar(255) null,
    price       decimal(10, 2) null,
    created_at  datetime default CURRENT_TIMESTAMP not null,
    constraint id
        unique (id)
);
