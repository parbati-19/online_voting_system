<?php
class HomeController extends Controller{

    public function index(){
        $this->view('home',['message' => 'Welcome to E-voting System']);
    }
}
?>