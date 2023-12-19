<?php
require_once 'config.php';

class User
{
    private $id;
    private $firstName;
    private $lastName;
    private $email;
    private $password;

    private $db; // Database connection

    public function __construct()
    {
        // Initialize database connection
        $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getAll()
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->query('SELECT * FROM cms_user');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $db->prepare('SELECT * FROM users WHERE id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        // You should hash the password before storing it in a real-world scenario
        $this->password = $password;
    }

    public function save()
    {
        $query = $this->db->prepare('INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)');
        $query->bindParam(':first_name', $this->firstName, PDO::PARAM_STR);
        $query->bindParam(':last_name', $this->lastName, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':password', $this->password, PDO::PARAM_STR);
        $query->execute();
    }

    public function update()
    {
        $query = $this->db->prepare('UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, password = :password WHERE id = :id');
        $query->bindParam(':id', $this->id, PDO::PARAM_INT);
        $query->bindParam(':first_name', $this->firstName, PDO::PARAM_STR);
        $query->bindParam(':last_name', $this->lastName, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->bindParam(':password', $this->password, PDO::PARAM_STR);
        $query->execute();
    }

    public function delete()
    {
        $query = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $query->bindParam(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
    }
}
?>