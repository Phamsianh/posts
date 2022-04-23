-- list all foreignkey constraint name

select *
from information_schema.referential_constraints
where constraint_schema = 'comments';


ALTER TABLE comments
drop CONSTRAINT comments_ibfk_2;

ALTER TABLE comments
ADD CONSTRAINT comments_ibfk_2
    FOREIGN KEY (post_id)
    REFERENCES posts
        (id)
    ON DELETE CASCADE;