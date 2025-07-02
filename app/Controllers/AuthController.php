<?php
class AuthController extends Controller
{

    private $model;
    public function __construct()
    {
        $this->model = $this->model('User');
    }
    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim(filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL));
            $password = trim($_POST['password'] ?? '');

            $errors = [];

            // email validation
            if (empty($email)) {
                $errors['email'] = 'Email is required.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format.';
            }

            // password validation
            if (empty($password)) {
                $errors['password'] = 'Password is required.';
            }

            // if any errors , return to the same view with updated errors
            if (!empty($errors)) {
                $this->view('auth/login', ['errors' => $errors]);
                return;
            }

            
            // admin login
            //assign adminemail and password for accessing admin dashboard
            $adminEmail = 'adminelection@gmail.com';
        $adminPasswordHash = password_hash('adminelection123', PASSWORD_DEFAULT);
            if ($email == $adminEmail && password_verify($password, $adminPasswordHash)) {
                $_SESSION['admin'] = [
                    'adminEmail' => 'adminelection@gmail.com',
                ];
                $_SESSION['isLoggedIn'] = true;
                header('Location: index.php?url=admin/dashboard');
                exit;
            }

            // voter login
            // check whether $user exits or not and if exits then give access to voter homepage
            $user = $this->model->authenticate($email, $password);
            if ($user !== false) {
                $_SESSION['user'] = [
                    'id'  => $user['id'],
                    'username' => $user['name'],
                    'email' => $user['email'],
                    'dateofbirth' => $user['dob'],
                ];
                $_SESSION['isLoggedIn'] = true;
                header('Location: index.php?url=voter/home');
                exit;
            }

            // return to login view if invalid credentials
            else {
                $error['email'] = 'Invalid Credentials';
                $this->view('auth/login', ['errors' => $error]);
                return;
            }
        }

        $this->view('auth/login');
    }

    public function register()
    {
        // works only when coming a Post method from the register form
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $errors = [];
            $data['fullname'] = $_POST['username'] ?? '';
            $data['email'] = $_POST['email'] ?? '';
            $data['dob'] = $_POST['dob'] ?? '';
            $data['password'] = $_POST['password'] ?? '';
            $confirmpassword = $_POST['confirmpassword'] ?? '';

            //validate fullname 
            if (empty($data['fullname'])) {
                $errors['fullname'] = 'Name is required';
            }

            // validate email
            if (empty($data['email'])) {
                $errors['email'] = 'Email is required';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format';
            } else {
                // check if user with this email already exists?
                if ($this->model->getUserbyEmail($data['email'])) {
                    $errors['email'] = 'Email already registered !';
                }
            }

            // validate age with dateOfbirth
            $dob = new DateTime($data['dob']);
            $todayDate = new DateTime();
            $age = $todayDate->diff($dob)->y;
            if (empty($data['dob'])) {
                $errors['dob'] = 'DateOfBirth is required';
            } elseif ($age < 18) {
                $errors['dob'] = 'Voter must be 18 or older !';
            }

            // validate password
            if (empty($data['password'])) {
                $errors['password'] = 'Password is required !';
            } elseif ($data['password'] !== $confirmpassword) {
                $errors['password'] = 'Password donot match !';
            }

            // return the register view with errors if any validation errors
            if (!empty($errors)) {
                $this->view('auth/register', ['errors' => $errors]);
                return;
            }

            //attempting to register an user  
            if ($this->model->register($data)) {
                $_SESSION['message'] = 'User registered successfully , go to login !';
                header('Location: index.php?url=auth/register');
                exit;
            } else {
                $errors['message'] = 'registration failed !';
                $this->view('auth/register', ['errors' => $errors]);
                return;
            }
        }

        // if there is no form submit, returns the register view simply
        $this->view(view: 'auth/register');
    }


    public function logout()
    {
        session_destroy();
        header('Location: index.php?url=auth/login');
        exit;
    }
}