<?php
class Candidate extends Model
{
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT 
                candidates.*, 
                elections.title AS election_title 
            FROM 
                candidates 
            LEFT JOIN 
                elections ON candidates.election_id = elections.id");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Fetch by a unique id 
    public function getById($id)
    {
        // Use prepared statements to prevent SQL injection
        $stmt = $this->db->prepare("SELECT * FROM candidates WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Fetch a single row 
        return $stmt->get_result()->fetch_assoc();
    }

// fetch by electionId
    public function getByElectionId($election_id)
    {
        $stmt = $this->db->prepare("SELECT * FROM candidates WHERE election_id = ?");
        $stmt->bind_param("i", $election_id);
        $stmt->execute();

        //fetch an array  
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    public function store($data)
    {
        $stmt = $this->db->prepare("INSERT INTO candidates (name, bio, photo, election_id) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $data['name'], $data['bio'], $data['photo_name'], $data['election_id']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE candidates SET name = ?, bio = ?, photo = ?, election_id = ? WHERE id = ?");
        $stmt->bind_param('sssii', $data['name'], $data['bio'], $data['photo'], $data['election_id'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM candidates WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}