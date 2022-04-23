<?php
include_once "BaseModel.php";

class Post extends BaseModel
{
    protected $tablename = "posts";

    public function get_all (
        int $limit = 10,
        int $offset = 0,
    ) {
        $stmt = $this->conn->prepare("SELECT * FROM posts LIMIT ? OFFSET ?");
        $stmt->bind_param('ii', $limit, $offset);
        $stmt->execute();

        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $result;
    }

    public function length () {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM posts");
        $stmt->execute();

        $result = $stmt->get_result()->fetch_array();
        $stmt->close();
        return $result[0];
    }

    public function post(
        string $author_id,
        string $title,
        string $content,
        string $description
    ){
        $stmt = $this->conn->prepare("INSERT INTO posts (author_id, title, content, description) VALUE (?, ?, ?, ?)");
        $stmt->bind_param('isss', $author_id, $title, $content, $description);
        $stmt->execute();
        $result = $this->get_from_id($this->conn->insert_id);
        $stmt->close();
        return $result;
    }

    public function update(
        string $id,
        string $title,
        string $content,
        string $description
    ){
        $stmt = $this->conn->prepare("UPDATE posts SET title = ?, content = ?, description = ? WHERE posts.id = ?");
        $stmt->bind_param('sssi',  $title, $content, $description, $id);
        $stmt->execute();
        $result = $this->get_from_id($id);
        $stmt->close();
        return $result;
    }

    public function delete(
        int $id,
    ){
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE posts.id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        return;
    }
}

?>