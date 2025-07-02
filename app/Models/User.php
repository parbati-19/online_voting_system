<?php
class User extends Model{
    public function getUserById(){
        
    }

    // fetch users by their email from users table
    public function getUserbyEmail($email){
        $stmt = $this->db ->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s',$email);
        $stmt->execute();

        return $stmt->get_result()->fetch_assoc();
    }

    // check whether any user by email and corresponding hashed password exists or not
    public function authenticate($email,$password){
        $user = $this -> getUserbyEmail($email);
        if($user && password_verify($password,$user['password'])){
            return $user;
        }
        return false;    //authentication fails
    }

    // insert new user into users table
    public function register($data){
        $hashed_password = password_hash($data['password'],PASSWORD_DEFAULT);
        $stmt = $this->db ->prepare("INSERT INTO users(name,email,dob,password) VALUES (?,?,?,?)");
        $stmt -> bind_param('ssss',$data['fullname'],$data['email'],$data['dob'],$hashed_password);
        return $stmt -> execute();  
    }
}