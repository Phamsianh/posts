<?php
include_once "BaseModel.php";

class Comment extends BaseModel
{
    protected $tablename = "comments";

    public function post(
        int $author_id,
        int $post_id,
        string $content
    ){
        $stmt = $this->conn->prepare("INSERT INTO comments (author_id, post_id, content) VALUE (?, ?, ?)");
        $stmt->bind_param('iis', $author_id, $post_id, $content);
        $stmt->execute();
        $result = $this->get_from_id($this->conn->insert_id);
        $stmt->close();
        return $result;
    }

    public function update(
        int $id,
        string $content
    ){
        $stmt = $this->conn->prepare("UPDATE comments SET content = ? WHERE comments.id = ?");
        $stmt->bind_param('si', $content, $id);
        $stmt->execute();
        $result = $this->get_from_id($id);
        $stmt->close();
        return $result;
    }

    public function delete(
        int $id,
    ){
        $stmt = $this->conn->prepare("DELETE FROM comments WHERE comments.id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
        return;
    }
}
?>