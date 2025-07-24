<?php
class Vote extends Model
{
    public function getAllVotes()
    {
        $stmt = $this->db->prepare("SELECT * FROM votes");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function hasVoted($userId, $electionId)
    {
        $stmt = $this->db->prepare("SELECT * FROM votes WHERE user_id = ? AND election_id = ? ");
        $stmt->bind_param('ii', $userId, $electionId);
        $stmt->execute();
    }

    public function store($data)
    {
        $stmt = $this->db->prepare("INSERT INTO votes (user_id, election_id, candidate_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $data['user_id'], $data['election_id'], $data['candidate_id']);
        return $stmt->execute();
    }

    public function getRecentVoters($limit = 5)
    {
        $stmt = $this->db->prepare("
        SELECT users.name, users.email, users.dob
        FROM votes
        JOIN users ON users.id = votes.user_id
        GROUP BY users.id
        ORDER BY MAX(votes.id) DESC
        LIMIT ?
    ");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getVoteCountByElection($electionId)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as vote_count FROM votes WHERE election_id = ?");
        $stmt->bind_param("i", $electionId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['vote_count'];
    }

    public function countAllVotes()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM votes");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function countAllVoters()
    {
        $stmt = $this->db->prepare("SELECT COUNT(DISTINCT user_id) as total FROM votes");
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }
}