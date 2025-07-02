<?php
class ElectionController extends Controller
{
    private $model;
    public function __construct()
    {
        if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
            header("Location: index.php?url=auth/login");
            exit;
        }
        $this->model = $this->model('Election');
    }

    public function index()
    {
        $elections = $this->model->getAll();
        $this->view('admin/elections/index', ['elections' => $elections]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $data['title'] = isset($_POST['title']) ? trim($_POST['title']) : ' ';
            $data['description'] = isset($_POST['description']) ? trim($_POST['description']) : ' ';
            $data['start_date'] = isset($_POST['start_date']) ? trim($_POST['start_date']) : ' ';
            $data['end_date'] = isset($_POST['end_date']) ? trim($_POST['end_date']) : ' ';
            $data['status'] = isset($_POST['status']) ? trim($_POST['status']) : ' ';

            // validate title
            if (empty($data['title'])) {
                $errors['title'] = "Title is required!";
            } elseif (strlen($data['title']) < 3) {
                $errors['title'] = "Title must be atleast 3 characters !";
            }

            // validate description
            if (empty($data['description'])) {
                $errors['description'] = "Description is required !";
            }

            // validate start date
            if (empty($data['start_date'])) {
                $errors['start_date'] = "Start date is required !";
            } elseif (!strtotime($data['start_date'])) {
                $errors['start_date'] = "Invalid Start date!";
            }

            // validate end date
            if (empty($data['end_date'])) {
                $errors['end_date'] = "End date is required !";
            } elseif (!strtotime($data['end_date'])) {
                $errors['end_date'] = "Invalid End date!";
            } elseif (strtotime($data['end_date']) < strtotime($data['start_date'])) {
                $errors['end_date'] = "End date must be after the start date !";
            }

            // validate status
            $allowedStatus = ['upcoming', 'active', 'ended'];
            if (!in_array($data['status'], $allowedStatus)) {
                $errors['status'] = "Invalid Status selected!";
            }

            // if errors isnot empty,redirect to same view with errors
            if (!empty($errors)) {
                $this->view('admin/elections/create', ['errors' => $errors]);
                return;
            }

            // store created election 
            if ($this->model->store($data)) {
                $_SESSION['message'] = "Election is created successfully ! ";
                header('Location: index.php?url=election/index');
                exit;
            } else {
                $errors['message'] = "Election creation failed !";
                $this->view('admin/elections/create', ['errors' => $errors]);
                return;
            }
        }
        $this->view('admin/elections/create', ['message' => 'We are creating a election here !']);
    }

    public function edit($id)
    {

        $election = $this->model->getById($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $data['title'] = isset($_POST['title']) ? trim($_POST['title']) : ' ';
            $data['description'] = isset($_POST['description']) ? trim($_POST['description']) : ' ';
            $data['start_date'] = isset($_POST['start_date']) ? trim($_POST['start_date']) : ' ';
            $data['end_date'] = isset($_POST['end_date']) ? trim($_POST['end_date']) : ' ';
            $data['status'] = isset($_POST['status']) ? trim($_POST['status']) : ' ';

            // validate title
            if (empty($data['title'])) {
                $errors['title'] = "Title is required!";
            } elseif (strlen($data['title']) < 3) {
                $errors['title'] = "Title must be atleast 3 characters !";
            }
            // validate description
            if (empty($data['description'])) {
                $errors['description'] = "Description is required !";
            }

            // validate start date
            if (empty($data['start_date'])) {
                $errors['start_date'] = "Start date is required !";
            } elseif (!strtotime($data['start_date'])) {
                $errors['start_date'] = "Invalid Start date!";
            }
            // validate end date
            if (empty($data['end_date'])) {
                $errors['end_date'] = "End date is required !";
            } elseif (!strtotime($data['end_date'])) {
                $errors['end_date'] = "Invalid End date!";
            } elseif (strtotime($data['end_date']) < strtotime($data['start_date'])) {
                $errors['end_date'] = "End date must be after the start date !";
            }

            // validate status
            $allowedStatus = ['upcoming', 'active', 'ended'];
            if (!in_array($data['status'], $allowedStatus)) {
                $errors['status'] = "Invalid Status selected!";
            }

            // if errors isnot empty,redirect to same view with errors
            if (!empty($errors)) {
                $this->view('admin/elections/create', ['errors' => $errors]);
                return;
            }

             // store created election 
            if ($this->model->update($id, $data)) {
                $_SESSION['message'] = "Election is updated successfully ! ";
                header('Location: index.php?url=election/index');
                exit;
            } else {
                $errors['message'] = "Election updation failed !";
                $this->view('admin/elections/edit', ['errors' => $errors]);
                return;
            }
        }

        $this->view('admin/elections/edit', ['election' => $election]);
    }

    public function delete($id) {
        $this->model->delete($id); 
        $_SESSION['message'] = "Election deleted successfully!";
        header("Location: index.php?url=election/index");
        exit;
    }
}