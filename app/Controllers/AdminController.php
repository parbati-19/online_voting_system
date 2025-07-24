<?php
class AdminController extends Controller
{
    private $model;

    public function __construct() {}

    public function dashboard()
    {
        $voteModel = $this->model('Vote');
        $electionModel = $this->model('Election');

        $recentVoters = $voteModel->getRecentVoters(5);
        $totalVoters = $voteModel->countAllVoters();
        $totalVotes = $voteModel->countAllVotes();
        $elections = $electionModel->getAll();

        $this->view('admin/dashboard', [
            'recentVoters' => $recentVoters,
            'totalVoters' => $totalVoters,
            'activeElectionsCount' => count($electionModel->getActive()),
            'totalVotes' => $totalVotes,
            'elections' => $elections,
        ]);
    }
}