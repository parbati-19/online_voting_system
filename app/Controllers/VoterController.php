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
        $this->view('voter/ballots/index', ['election' => $election, 'candidates' => $candidates, 'user_id' => $userId]);
    }

    public function vote()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user']['id'] ?? null;

            $data = [
                'user_id' => $userId,
                'election_id' => $_POST['election_id'],
                'candidate_id' => $_POST['candidate_id'],
            ];

            if (!$userId) {
                echo "User is not logged in.";
                return;
            }

            if ($this->model->hasVoted($userId, $data['election_id'])) {
                $_SESSION['message'] = "You have already voted for this election!";
                header('Location: index.php?url=vote/index');
                return;
            }

            if ($this->model->store($data)) {
                $_SESSION['message'] = 'Vote cast successfully, Thank you for your vote!';
                header('Location: index.php?url=voter/index');
                exit;
            } else {
                echo "Error while casting vote.";
            }
        }
    }

}