<?php
class Election extends Model
{
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM elections");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getById($id)
    {
        // Use prepared statements to prevent SQL injection
        $stmt = $this->db->prepare("SELECT * FROM elections WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        // Fetch a single row
        return $stmt->get_result()->fetch_assoc();
    }

    public function getUpcoming()
    {
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("SELECT * FROM elections WHERE start_date > ? ORDER BY start_date ASC");
        $stmt->bind_param("s", $now);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getActive(){
        $now = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("SELECT * FROM elections WHERE start_date <= ? AND end_date>=  ? ORDER BY end_date ASC");
        $stmt->bind_param("ss", $now, $now);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


    public function store($data)
    {
        $stmt = $this->db->prepare("INSERT INTO elections (title,description,start_date,end_date,status) VALUES (?,?,?,?,?)");
        $stmt->bind_param('sssss', $data['title'], $data['description'], $data['start_date'], $data['end_date'], $data['status']);
        return $stmt->execute();
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE elections SET title = ?, description = ?, start_date = ?, end_date = ?, status = ? WHERE id = ?");
        $stmt->bind_param("sssssi", $data['title'], $data['description'], $data['start_date'], $data['end_date'], $data['status'], $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM elections WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}