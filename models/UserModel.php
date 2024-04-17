<?php

class UserModel
{
    public $db;

    public function __construct()
    {
        $this->db = new SQLite3("database-tes_oshs.db");

        if (!$this->db) {
            die("Connection failed: " . $this->db->lastErrorMsg());
        }

        $query = "CREATE TABLE IF NOT EXISTS users (
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    name TEXT NOT NULL,
                    email TEXT NOT NULL,
                    password TEXT NOT NULL,
                    status INTEGER DEFAULT 1
                );";

        $this->db->exec($query);
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function getUsers()
    {
        $query = "SELECT * FROM users";
        $result = $this->db->query($query);
        $users = [];

        while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
            $users[] = $row;
        }

        return $users;
    }

    public function signUp($name, $email, $password)
    {
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        return $this->db->changes();
    }

    public function editUser($id, $name, $email, $status)
    {
        // var_dump($id, $name, $email, $status);
        // die();
        $query = "UPDATE users SET name = :name, email = :email, status = :status WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        return $this->db->changes();
    }

    public function deleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $this->db->changes();
    }
}
