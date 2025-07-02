<?php
class AdminController extends Controller{
    private $model;
    
    public function __construct(){
        
        
    }

    public function dashboard(){
        $this->view('admin/dashboard',['message'=>'Welcome Admin to our E-vote']);
    }
     
}