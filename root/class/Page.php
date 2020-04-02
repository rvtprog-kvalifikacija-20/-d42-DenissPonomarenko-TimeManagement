<?php
    class Page{
        private $state;

        public function __construct( $state ) {
            
            $this->state = $state;
        }

        private function show_head(){
            include "page_details/head.php";
        }

        private function show_navigation(){
            include "page_details/navigation.php";
        }

        private function show_footer(){
            include "page_details/footer.php";
        }

        private function show_login(){
            include "login.php";
        }

        private function show_projects(){
            include "projects.php";
        }

        private function show_supports(){
            include "support_list.php";
        }


        public function show(){

            $state = $this->state;
            if( $state == "login" ){
                $this->show_head();
                $this->show_login();
                $this->show_footer();
            }
            elseif( $state == "projects" ){
                $this->show_head();
                $this->show_navigation();

                $this->show_projects();

                $this->show_footer();
            }
            elseif( $state == "supports" ) {
                $this->show_head();
                $this->show_navigation();

                $this->show_supports();

                $this->show_footer();
            }
        }
    }

?>