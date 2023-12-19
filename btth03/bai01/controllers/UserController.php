<?php
require_once 'models/User.php';

class UserController
{
    // Display a list of users
    public function index()
    {
        $users = User::getAll();
        // If UserController.php is in a different directory than bai01
        require('./controllers/UserController.php');

    }

    // Display the user creation form
    public function create()
    {
        require 'views/create.php';
    }

    // Store a newly created user in the database
    public function store()
    {
        // If index.php is in the bai01 directory and UserController.php is in the controllers directory
require_once('../controllers/UserController.php');

    }

    // Display the user editing form
    public function edit()
    {
        $id = $_GET['id'];
        $user = User::getById($id);
        require 'views/users/edit.php';
    }

    // Update the specified user in the database
    public function update()
    {
        $id = $_POST['id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $type = $_POST['type'];

        $user = User::getById($id);
        $user->setFirstName($firstName);
        $user->setLastName($lastName);
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setType($type);
        $user->save();

        header('Location: index.php?controller=user&action=index');
    }

    // Delete the specified user from the database
    public function delete()
    {
        $id = $_GET['id'];
        $user = User::getById($id);
        $user->delete();

        header('Location: index.php?controller=user&action=index');
    }
}
?>