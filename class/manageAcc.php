<?php
class AccountManager
{
    private $conn;

    // Constructor to initialize the connection
    public function __construct($db_conn)
    {
        $this->conn = $db_conn;
    }

    public function changeName($u_id, $new_name)
    {
        $sql = "UPDATE accounts SET u_name = :new_name WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_name', $new_name, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function changePassword($u_id, $new_password)
    {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE accounts SET password = :new_password WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_password', $hashed_password, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function changeEmail($u_id, $new_email)
    {
        $sql = "UPDATE accounts SET email = :new_email WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':new_email', $new_email, PDO::PARAM_STR);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function deleteAccount($u_id)
    {
        $sql = "DELETE FROM accounts WHERE u_id = :u_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':u_id', $u_id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
