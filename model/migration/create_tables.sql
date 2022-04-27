drop table if exists `comments`;
drop table if exists `posts`;
drop table if exists `users`;

create table `users` (
	id bigint not null auto_increment primary key,
    created_at timestamp not null default CURRENT_TIMESTAMP,
    username varchar(50) not null,
    password varchar(50) not null,
    firstname varchar(50) not null,
    lastname varchar(50) not null,
    birthdate date,
    phone int(20)
);

create table `posts`(
	id bigint not null auto_increment primary key,
    created_at timestamp not null default CURRENT_TIMESTAMP,
    author_id bigint not null,
    title varchar(200) not null,
    content text not null,
    description text not null,
    
    foreign key (author_id) references users(id) on delete cascade
);

create table `comments`(
	id bigint not null auto_increment primary key,
    created_at timestamp not null default CURRENT_TIMESTAMP,
    author_id bigint not null,
    post_id bigint not null,
    content text not null,
    
    foreign key (author_id) references users(id) on delete cascade,
    foreign key (post_id) references posts(id) on delete cascade
);

drop table if exists `tokens`;
create table `tokens`(
	id varchar(255) not null primary key,
    created_at timestamp not null default CURRENT_TIMESTAMP,
    user_id bigint not null,
    active boolean not null,
    foreign key (user_id) references users(id)
);
