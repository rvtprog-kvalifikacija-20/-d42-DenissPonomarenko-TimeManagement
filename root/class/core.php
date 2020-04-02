<?php
    require_once("class/page.php");

    class Core {
        
        private $user_login;
        private $user_password;

        private $state = "supports";



        public function set_login( $login ){
            $this->user_login = $login;
        }

        public function get_login() {
            return $this->user_login;
        }

        public function set_password( $password ){
            $this->user_password = $password;
        }

        public function get_password(){
            return $this->user_password;
        }

        public function set_session_data(){
            $_SESSION['login']    = $this->user_login;
            $_SESSION['password'] = $this->user_password;
        }

        public function get_session_login(){
            return $_SESSION['login'];
        }

        public function get_session_password(){
            return $_SESSION['password'];
        }

        public function create_request(){
            return 1;
        }

        public function send_request(){
            $request = create_request();
        }

        public function get_answer(){
            return 1;
        }


        public function print_data(){
            echo $user_login;
            echo $user_password;
        }

        public function show_page(){
            $page = new Page( $this->state );
            $page->show();
        }

    }
?>