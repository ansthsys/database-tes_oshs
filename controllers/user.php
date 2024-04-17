<?php

class User extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
    }

    public function index()
    {
        $user = $this->load_model("UserModel");
        $users = $user->getUsers();

        $this->render->view('sign-up', ['users' => $users]);
    }

    public function signUp()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

            $user = $this->load_model("UserModel");
            $user->signUp($name, $email, $password);
            header("Location: ../");
        } else {
            return throw new Exception("Method Not Allowed", 405);
        }
    }

    public function edit()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // return var_dump($_POST);
            $id = $_POST["id"];
            $name = $_POST["name"];
            $email = $_POST["email"];
            $status = boolval($_POST["status"]);

            $user = $this->load_model("UserModel");
            $user->editUser($id, $name, $email, $status);
            header("Location: ../");
        } else {
            return throw new Exception("Method Not Allowed", 405);
        }
    }

    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];

            $user = $this->load_model("UserModel");
            $user->deleteUser($id);
            header("Location: ../");
        } else {
            return throw new Exception("Method Not Allowed", 405);
        }
    }
}
