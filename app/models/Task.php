<?php

class Task
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function count()
    {
        $this->db->query('SELECT * FROM tasks');
        $this->db->execute();
        $count = $this->db->rowCount();
        return $count;
    }

    public function getTasks($start, $limit, $sort)
    {
        $this->db->query('SELECT * FROM tasks ORDER BY '. $sort .' LIMIT :limit OFFSET :offset');
        $this->db->bind(':offset', $start);
        $this->db->bind(':limit', $limit);
        $this->db->execute();
        $result = $this->db->resultSet();
        return $result;
    }

    public function updateTask($data)
    {
        $this->db->query('UPDATE tasks SET user_name = :username, user_email = :useremail, task = :task, fulfilled = :fulfilled WHERE id=:id');
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':useremail', $data['useremail']);
        $this->db->bind(':task', $data['task']);
        $this->db->bind(':fulfilled', $data['fulfilled']);
        if ($this->db->execute()) {
            return true;
        }else{
            return false;
        }

    }

    public function getTaskById($id)
    {
        $this->db->query('SELECT * FROM tasks WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;
    }

    public function deleteTaskById($id)
    {
        $this->db->query('DELETE FROM tasks WHERE id=:id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()){
            return true;
        }else{
            return true;
        }
    }

    public function addTask($data)
    {
        $this->db->query('INSERT INTO tasks (user_name, user_email, task) VALUES (:name, :email, :task)');
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':task', $data['task']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
}