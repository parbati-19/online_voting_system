<?php
class voterController extends Controller
{
    private $model;

    public function __construct()
    {
        if (!isset($_SESSION['isLoggedIn']) || !$_SESSION['isLoggedIn']) {
            header("Location: index.php?url=auth/login");
            exit;
        }
        $this->model = $this->model('Vote');
    }

    public function index()
    {

        $upcomingElections = $this->model('Election')->getUpcoming();
        $activeElections = $this->model('Election')->getActive();

        $this->view(
            'voter/index',
            [
                'upcomingElections' => $upcomingElections,
                'activeElections' => $activeElections,
            ]
        );
    }


    public function ballot($userId, $electionId)
    {
        if ($this->model->hasVoted($userId, $electionId)) {
            $_SESSION['message'] = "You have already voted for this election! ";
            header('Location: index.php?url=vote/index');
            return;
        }

        $election = $this->model('Election')->getById($electionId);
        $candidates = $this->model('Candidate')->getByElectionId($electionId);
        $this->view('voter/ballots/index', ['election' => $election, 'candidates' => $candidates]);
    }

    public function vote()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'user_id' => $_POST['user_id'],
                'election_id' => $_POST['election_id'],
                'candidate_id' => $_POST['candidate_id'],
            ];

            if ($this->model->hasVoted($data['userId'], $data['electionId'])) {
                $_SESSION['message'] = "You have already voted for this election! ";
                header('Location: index.php?url=vote/index');
                return;
            }

            if ($this->model->store($data)) {
                header("Location: index.php?url=voter/thankyou");
            } else {
                echo "Error while casting vote.";
            }
        }
    }

    public function thanyou()
    {
        echo "Thankyou for your vote! ";
        $this->view("voter/ballot/index");
    }
}