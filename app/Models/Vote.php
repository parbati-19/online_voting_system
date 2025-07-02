<?php
class Vote extends Model
{
    public function getAllVotes()
    {
        $stmt = $this->db->prepare("SELECT * FROM votes");
        $stmt -> execute();
        return $stmt -> get_result() -> fetch_assoc();
    }

    public function hasVoted($userId, $electionId){
        $stmt = $this ->db->prepare("SELECT * FROM votes WHERE user_id = ? AND election_id = ? ");
        $stmt -> bind_param('ii',$userId, $electionId);
        $stmt -> execute(); 
    }

    public function store($data)
    {
        $stmt = $this->db->prepare("INSERT INTO votes (user_id, election_id, candidate_id) VALUES (?, ?, ?)");
        $stmt->bind_param("iii", $data['user_id'], $data['election_id'], $data['candidate_id']);
        return $stmt->execute();
    }
}