<?php
    include_once( '../functions/functions.php');     
    session_start();
    
    $_SESSION['new_task_error'] = "";

    switch( $_SESSION['state'] ){

        case 'login':
            $_SESSION['username'] = $_POST['login'];
            $_SESSION['password'] = $_POST['password'];
        
            $user = "";
        
            $result = f_get_my_id();
            $user = $result->{'body'}->{'user'};
        
            if( !empty( $user ) ){
                $_SESSION['user_id'] = (string)$user->user_id;
                $_SESSION['user_type'] = (string)$user->user_type;
                $_SESSION['state']   = 'projects';
            }else{
                $_SESSION['state'] = 'login';
                $_SESSION['login_error'] = 'Пользователь не найден';
            }
        break;

        case 'new_task':

            $_SESSION['new_task_name']        = $_POST['o_name'];
            $_SESSION['new_task_description'] = $_POST['task'];
            $_SESSION['new_task_date_start']  = $_POST['date_start'];
            $_SESSION['new_task_date_end']    = $_POST['date_end'];
            $_SESSION['new_task_worker']      = $_POST['worker'];
            $_SESSION['new_task_manager']     = $_POST['manager'];
    
            $_SESSION['new_task_error']       = new_task_validation( $_SESSION['new_task_manager'], $_SESSION['new_task_worker'], $_SESSION['new_task_name'], $_SESSION['new_task_date_start'], $_SESSION['new_task_date_end'], $_SESSION['new_task_description'] );

            if( $_SESSION['new_task_error'] == "Задача успешно заведена" ){ 
                f_za_create( $_SESSION['new_task_manager'], $_SESSION['new_task_worker'], $_SESSION['new_task_name'], $_SESSION['new_task_date_start'], $_SESSION['new_task_date_end'], $_SESSION['new_task_description'] );

                unset( $_SESSION['new_task_name'] );
                unset( $_SESSION['new_task_description'] );
                unset( $_SESSION['new_task_date_start'] );
                unset( $_SESSION['new_task_date_end'] );
                unset( $_SESSION['new_task_worker'] );
                unset( $_SESSION['new_task_manager'] );
            }else{
                break;
            }
            

        break;
    }
    header("Location: /");
?>