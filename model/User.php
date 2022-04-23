<?php
include "BaseModel.php";

class User extends BaseModel
{
    protected $tablename = "users";

    public function get_from_username(string $username) 
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        return $result;
    }

    public function post(
        string $username, 
        string $password, 
        string $firstname, 
        string $lastname, 
        string $birthdate = null, 
        int $phone = null) {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, firstname, lastname, birthdate, phone) VALUE (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param('sssssi', $username, $password, $firstname, $lastname, $birthdate, $phone);
            $stmt->execute();
            $result = $this->get_from_id($this->conn->insert_id);
            $stmt->close();
            return $result;
    }

    public function update (
        int $id = null,
        string $firstname, 
        string $lastname, 
        string $birthdate = null, 
        int $phone = null
    ){
        $stmt = $this->conn->prepare("UPDATE users SET firstname = ?, lastname = ?, birthdate = ?, phone = ? WHERE id = ?");
        $stmt->bind_param('sssii', $firstname, $lastname, $birthdate, $phone, $id);
        $stmt->execute();
        $result = $this->get_from_id($id);
        $stmt->close();
        return $result;
    }

    
    public function change_password (
        int $id,
        string $password
    ) {
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param('si', $password, $id);
        $stmt->execute();
        $result = $this->get_from_id($id);
        $stmt->close();
        return $result;
    }

    public function get_posts(
        int $user_id
    ){
        $stmt = $this->conn->prepare("
        SELECT * 
        FROM posts 
        WHERE posts.author_id = ?
        ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function get_comments(
        int $post_id
    ){
        $stmt = $this->conn->prepare("
        SELECT * 
        FROM comments 
        WHERE comments.post_id = ?
        ");
        $stmt->bind_param('i', $post_id);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function get_posts_full(
        int $user_id
    ){
        $stmt = $this->conn->prepare("
        select 
            posts.created_at as posts_created_at,
            posts.title as post_title,
            posts.content as posts_content,
            posts.description as post_description,
            concat(posts_author.firstname, ' ', posts_author.lastname) as posts_author,
            comments.content as comments_content,
            comments.created_at as comments_created_at,
            concat(comments_author.firstname, ' ', comments_author.lastname) as comments_author
        from posts, users as posts_author, comments, users as comments_author
        where posts.author_id = ?
        and comments.post_id = posts.id
        and comments.author_id = comments_author.id
        ");
        $stmt->bind_param('i', $user_id);
        $stmt->execute();

        $posts = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $posts;
    }
}
?>