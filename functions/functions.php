<?php

    function login_validation( $login, $password ){

        $login = filter_var(trim($login), 
        FILTER_SANITIZE_STRING);
        $password = filter_var(trim($password), 
        FILTER_SANITIZE_STRING);

        $error_msg = "";

        if( $password == "" ){
            $error_msg = "Введите пароль";
        }
        if( $login == "" ){
            $error_msg = "Введите логин";
        }
        if( $login == "" && $password == ""){
            $error_msg = "Введите логин и пароль";
        }
        if( $error_msg == "" ){
            session_after_login( $login, $password );
        }else{
            return $error_msg;
        }
    }

    function check_session(){
        if( $_SESSION["username"] == "" && $_SESSION["password"] == "" ){
            header('Location: index.php');
        }
    }

    function session_after_login( $login, $password ){
        $_SESSION["username"] = $login;
        $_SESSION["password"] = $password;

        if( !isset( $_SESSION['username'] )){
            $_SESSION["state"] = "projects";
        }else{
            $_SESSION["state"] = "login";
        }
        header("Location: index.php");
    }

    function get_object_color( $o_id ){

        if( $o_id == 5 || $o_id == 6 ){
            $bootstrap_color_text = 'text-warning';
        }
        elseif( $o_id == 1 || $o_id == 2 || $o_id == 3 or $o_id == 4 ){
            $bootstrap_color_text = 'text-danger';
        }else{
            $bootstrap_color_text = 'text-primary';
        }
        
        return $bootstrap_color_text;
    }

    function show_page( $state ){

        if( !isset( $_SESSION["state"] ) ){
            change_state( 'login' );
        }
        if( isset( $_GET['state'] ) && !empty( $_GET['state'] ) ){
            $_SESSION["state"] = $_GET['state'];
        }
        switch ( $state ) {

            case "projects":
                include( "page_details/navigation.php" );
                include( "projects.php" );
                include( "page_details/footer.php" );
            break;

            case "tasks":
                include( "page_details/navigation.php" );
                include( "tasks.php" );
                include( "page_details/footer.php" );
            break;

            case "task":
                
                if( isset( $_GET['task'] ) && !empty( $_GET['task'] ) ){
                    $_SESSION['o_number'] = $_GET['task'];
                }

                include("page_details/navigation.php");
                include("task.php");
                include("page_details/footer.php" );
            break;

            case "supports":
                include("page_details/navigation.php");
                include("supports.php");
                include("page_details/footer.php" );
            break;

            case "support":
                include("page_details/navigation.php");
                include("support.php");
                include("page_details/footer.php" );
            break;

            case "users":
                include("page_details/navigation.php");
                include("users.php");
                include("page_details/footer.php" );
            break;

            case "user":
                include("page_details/navigation.php");
                include("user.php");
                include("page_details/footer.php" );
            break;

            case "new_task":
                include("page_details/navigation.php");
                include("new_task.php");
                include("page_details/footer.php" );
            break;

            default:
                include("login.php");
                include("page_details/footer.php");
            break;
        }
    }

    function change_state( $new_state ){
        $_SESSION["state"]  = $new_state;
    }

    function get_notes(){
        $_SESSION['test_login'] = "api.test";
        $_SESSION['test_pwd']   = "17042020";

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['test_login'].'" password="'.$_SESSION['test_pwd'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_za_get_notes_names"></function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }

    function f_za_my_tasks(){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_za_my_tasks"></function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }

    function f_za_make_note( $number, $text, $type, $time ){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_za_make_note">
                            <arg name="note_num">'. $number .'</arg>
                            <arg name="note_text">'. $text     .'</arg>
                            <arg name="note_type">'. $type     .'</arg>
                            <arg name="note_time">'. $time     .'</arg>
                        </function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}
        return $response;
    }

    function f_za_info( $number ){
        $authdata = base64_encode( '<authdata msg_id="1" user="api.test" password="17042020" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_za_info">
                            <arg name="o_num">'. $number .'</arg>
                        </function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            echo( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }


    // Выборка активный пользователей
    function f_za_select_users(){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_za_select_users"></function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }

    // Данные пользователя
    function f_get_user_data(){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_get_user_data">
                            <arg name="u_id">'. $_SESSION['u_id'] .'</arg>
                        </function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }



    // Выборка активный пользователей
    function f_zs_support_list(){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_zs_support_list">
                        </function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }

    // Данные для техподдержки
    function f_zs_support_data(){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_zs_support_data">
                            <arg name="s_num">'. $_SESSION['o_num'] .'</arg>
                        </function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }



    function f_za_create( $manager, $performer, $name, $date_start, $date_end, $description ){

        $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
        $body = '<?xml version="1.0" encoding="UTF-8"?>
                <sbapi>
                    <header>
                        <interface id="218120197" version="8" />
                        <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                        <error id="0" />    
                        <auth pwd="open">'.$authdata.'</auth>
                    </header>
                    <body>
                        <function name="f_za_create">
                            <arg name="o_manager">'. $manager .'</arg>
                            <arg name="o_worker">'. $performer .'</arg>
                            <arg name="o_name">'. $name .'</arg>
                            <arg name="o_date_start">'. $date_start .'</arg>
                            <arg name="o_date_end">'. $date_end .'</arg>
                            <arg name="o_description">'. $description .'</arg>
                        </function>
                    </body>
                </sbapi>';

        $header = array(
            "Content-type: text/xml",
            "Content-length: ".strlen( $body ),
            "Connection: close",
        );

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);


        $response = curl_exec( $ch );
        $errno    = curl_errno( $ch );
        if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}

        $response_xml = simplexml_load_string($response);
        $error = $response_xml->{'body'}->error;
        
        if( !empty( $error ) ){ 
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }

         // Комментарии
         function f_za_get_object_notes(){

            $authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );$authdata = base64_encode( '<authdata msg_id="1" user="'.$_SESSION['username'].'" password="'.$_SESSION['password'].'" msg_type="5000" user_ip="127.0.0.1" />' );
            $body = '<?xml version="1.0" encoding="UTF-8"?>
                    <sbapi>
                        <header>
                            <interface id="218120197" version="8" />
                            <message id="1" ignore_id="yes" type="5000" created="2023-10-23T12:34:56Z"/>
                            <error id="0" />    
                            <auth pwd="open">'.$authdata.'</auth>
                        </header>
                        <body>
                            <function name="f_za_get_object_notes">
                                <arg name="o_num">'. $_SESSION['o_num'] .'</arg>
                            </function>
                        </body>
                    </sbapi>';
    
            $header = array(
                "Content-type: text/xml",
                "Content-length: ".strlen( $body ),
                "Connection: close",
            );
    
            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_URL, 'https://demo-api.simbase.eu');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    
            $response = curl_exec( $ch );
            $errno    = curl_errno( $ch );
            if($errno){die("Curl error! Error code: $errno; See more at https://curl.haxx.se/libcurl/c/libcurl-errors.html");}
    
            $response_xml = simplexml_load_string($response);
            $error = $response_xml->{'body'}->error;
            
            if( !empty( $error ) ){ 
                die( 'API ERROR: '.$error ); 
            }
    
            return $response_xml;
        }


    function new_task_validation( $manager, $worker, $name, $date_start, $date_end, $task ){
        
        // f_za_create( $_POST['manager'], $_POST['worker'], $_POST['o_name'], $_POST['date_start'], $_POST['date_end'], $_POST['task'] );

        if( !isset( $manager ) || $manager == "" ){
            return "Необходимо выбрать контралера.";
        }
        else if( !isset( $worker ) || $worker == "" ){
            return "Необходимо выбрать исполнителя.";
        }
        else if( !isset( $name ) || $name == "" ){
            return "Необходимо указать тему задачи.";
        }
        else if( !isset( $date_start ) || $date_start == ""  ){
            return "Необходимо заполнить дату начала выполнения задачи.";
        }
        else if( !isset( $date_end ) || $date_end == "" ){
            return "Необходимо заполнить дату начала окончания задачи.";
        }
        else if( !isset( $task ) || $task == "" ){
            return "Необходимо описать задачу.";
        }
        else if( $date_end < $date_start ){
            return "Дата окончания не может быть меньше даты начала";
        }else{
            return "Задача успешно заведена";
        }
    }

?>