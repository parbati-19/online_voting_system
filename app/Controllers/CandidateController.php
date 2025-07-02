<?php
class CandidateController extends Controller
{
    private $model;
    public function __construct()
    {
        if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
            header("Location: index.php?url=auth/login");
            exit;
        }
        $this->model = $this->model('Candidate');
    }

    public function index()
    {
        $candidates = $this->model->getAll();
        $this->view('admin/candidates/index', ['candidates' => $candidates]);
    }

    public function create()
    {

        $elections = $this->model('Election')->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $data['name'] = isset($_POST['name']) ? trim($_POST['name']) : ' ';
            $data['bio'] = isset($_POST['bio']) ? trim($_POST['bio']) : ' ';
            $data['election_id'] = (int)$_POST['election_id'];

            // validate name
            if (empty($data['name'])) {
                $errors['name'] = "Name is required!";
            }

            // validate description
            if (empty($data['bio'])) {
                $errors['bio'] = "bio is required !";
            }

            // validate election id
            if (empty($data['election_id'])) {
                $errors['election_id'] = "Election must be selected!";
            }

            //Image uploading
            $photo_name = NULL;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $file_type = mime_content_type($_FILES['photo']['tmp_name']);
                $file_size = $_FILES['photo']['size'];

                if (!in_array($file_type, $allowed_types)) {
                    $errors['photo'] = "Only JPG, PNG, GIF, and WEBP files are allowed.";
                }

                if ($file_size > 2 * 1024 * 1024) {
                    $errors['photo'] = "Image must be less than 2 MB.";
                }

                $original_name = basename($_FILES['photo']['name']);
                $safe_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $original_name);
                $data['photo_name'] = time() . "_" . $safe_name;

                $upload_dir = __DIR__ . "/../../assets/images/";
                $targetfile = $upload_dir . $data['photo_name'];

                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $targetfile)) {
                    $errors['photo'] = "Failed to upload the image.";
                }
            }

            // if errors isnot empty,redirect to same view with errors
            if (!empty($errors)) {
                $this->view('admin/candidates/create', ['errors' => $errors, 'elections' => $elections]);
                return;
            }

            // store created candidate 
            if ($this->model->store($data)) {
                $_SESSION['message'] = "Candidate is created successfully ! ";
                header('Location: index.php?url=candidate/index');
                exit;
            } else {
                $errors['message'] = "Candidate creation failed !";
                $this->view('admin/candidates/create', ['errors' => $errors, '$elections' => $elections]);
                return;
            }
        }
        $this->view('admin/candidates/create', ['elections' => $elections]);
    }

    public function edit($id)
    {

        $candidate = $this->model->getById($id);
        $elections = $this->model('Election')->getAll();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];

            $data['name'] = isset($_POST['name']) ? trim($_POST['name']) : ' ';
            $data['bio'] = isset($_POST['bio']) ? trim($_POST['bio']) : ' ';
            $data['election_id'] = (int)$_POST['election_id'];
            $data['photo'] = $candidate['photo'];

            // validate name
            if (empty($data['name'])) {
                $errors['name'] = "Name is required!";
            }

            // validate description
            if (empty($data['bio'])) {
                $errors['bio'] = "bio is required !";
            }

            // validate election id
            if (empty($data['election_id'])) {
                $errors['election_id'] = "Election must be selected!";
            }

            // Handle new image upload
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                $file_type = mime_content_type($_FILES['photo']['tmp_name']);
                $file_size = $_FILES['photo']['size'];

                if (!in_array($file_type, $allowed_types)) {
                    $errors['photo'] = "Only JPG, PNG, GIF, and WEBP files are allowed.";
                }

                if ($file_size > 2 * 1024 * 1024) {
                    $errors['photo'] = "Image must be less than 2 MB.";
                }

                $original_name = basename($_FILES['photo']['name']);
                $safe_name = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $original_name);
                $new_image = time() . "_" . $safe_name;

                $upload_dir = __DIR__ . "/../../assets/images/";
                $targetfile = $upload_dir . $new_image;

                if (!move_uploaded_file($_FILES['photo']['tmp_name'], $targetfile)) {
                    $errors['photo'] = "Failed to upload the image.";
                }

                // Optionally delete the old image (optional):
                $old_path = $upload_dir . $candidate['photo'];
                if (file_exists($old_path) && $candidate['photo']) {
                    unlink($old_path);
                    $data['photo'] = $new_image;
                }
            }

            // if errors isnot empty,redirect to same view with errors
            if (!empty($errors)) {
                $this->view('admin/candidates/edit', ['errors' => $errors, 'candidate' => $candidate, 'elections' => $elections]);
                return;
            }

            // store created election 
            if ($this->model->update($id, $data)) {
                $_SESSION['message'] = "Candidate is updated successfully ! ";
                header('Location: index.php?url=candidate/index');
                exit;
            } else {
                $errors['message'] = "Candidate updation failed !";
                $this->view('admin/candidates/edit', ['errors' => $errors, 'candidate' => $candidate, 'elections' => $elections]);
                return;
            }
        }

        $this->view('admin/candidates/edit', ['candidate' => $candidate, 'elections' => $elections]);
    }

    public function delete($id)
    {
        $this->model->delete($id);
        $_SESSION['message'] = "Candidate deleted successfully!";
        header("Location: index.php?url=candidate/index");
        exit;
    }
}