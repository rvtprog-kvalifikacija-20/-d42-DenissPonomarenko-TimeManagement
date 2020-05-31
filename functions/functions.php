<?php

    define('FUNCTIONS',__DIR__);

    function login_validation( $login, $password ){

        $login    = filter_var(trim($login), FILTER_SANITIZE_STRING);
        $password = filter_var(trim($password), FILTER_SANITIZE_STRING);

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
            $_SESSION["state"] = "login";
        }
    }

    function check_number( $state ){

        if( $state == 'task' || $state == 'support' ){
            $needed = 'o_num';
        }

        if( $state == 'user' ){
            $needed = 'u';
        }
        
        if( empty( $_GET[$needed] ) ){

        }
        
        $_SESSION['state'] = 'error';
        header("Location: ".UI_PUBLIC_DIR."'\..\index.php");
    }

    function get_title(){

        switch( $_SESSION['state'] ){

            case 'login':
                echo 'Вход в систему';
            break;

            case 'projects':
                echo 'Проекты';
            break;

            case 'project':
                echo 'Проект - ' . $_SESSION['o_num'];
            break;

            case 'event':
                echo 'Мероприятие - ' . $_SESSION['o_num'];
            break;

            case 'supports':
                echo 'Техподдержка';
            break;

            case 'new_task':
                echo 'Новая задача';
            break;

            case 'tasks':
                echo 'Поручения';
            break;

            case 'task':
                echo 'Задача - ' . $_SESSION['o_num'];
            break;

            case 'users':
                echo 'Пользователи';
            break;

            case 'user':
                echo 'Пользователь';
            break;

            case 'error':
                echo 'Страница не найдена';
            break;
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

    function show_page(){

        switch ( $_SESSION["state"] ) {

            case "projects":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\projects.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "project":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\project.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "event":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\event.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "tasks":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\tasks.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "task":
                
                if( isset( $_GET['task'] ) && !empty( $_GET['task'] ) ){
                    $_SESSION['o_num'] = $_GET['task'];
                }

                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\task.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "supports":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\supports.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "support":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\support.php');
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "users":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\users.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "user":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\user.php');
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "new_task":
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\new_task.php');
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;
            
            case "change_state":
                include( UI_PUBLIC_DIR.'\..\change_state.php');
            break;

            case 'error':
                include( UI_PUBLIC_DIR.'\..\page_details\navigation.php');
                include( UI_PUBLIC_DIR.'\..\error.php');
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php');
            break;

            case "exit":
                session_destroy();
                header( "Location: /");
            break;

            default:
                include( UI_PUBLIC_DIR.'\..\login.php' );
                include( UI_PUBLIC_DIR.'\..\page_details\footer.php' );
            break;
        }
    }

    function change_state( $new_state ){
        $_SESSION["state"]  = $new_state;
    }

    function fill_field( $variable, $placeholder ){
        if( isset( $variable ) ){
            return 'value="'. $variable .'"';
        }else{ 
            return 'placeholder="' . $placeholder . '"'; 
        }
    }

    function get_notes(){

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
            die( $error ); 
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
    function f_get_user_data( $user_id ){

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
                        <function name="f_get_user_data">
                            <arg name="u_id">'. $user_id .'</arg>
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
                        <function name="f_zc_support_list">
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

    function f_zs_project_data( $number ){

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
                        <function name="f_zs_project_data">
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
            die( $error ); 
        }

        return $response_xml;
    }

    // Данные для техподдержки
    function f_zs_support_data(){

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


    // Данные для техподдержки
    function f_zs_project_list(){

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
                        <function name="f_zs_project_list">
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

    // Данные мероприятия
    function f_get_event_data( $number ){

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
                        <function name="f_get_event_data">
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
            die( 'API ERROR: '.$error ); 
        }

        return $response_xml;
    }



    function f_za_create( $manager, $performer, $name, $date_start, $date_end, $description ){

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


    function base64_to_jpeg($base64_string, $output_file) {

        if( empty( (string)$base64_string ) ){
            echo 'img\default_avatar.png';
            return null;
        }

        // open the output file for writing
        $ifp = fopen( $output_file, 'wb' ); 
    
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
    
        // we could add validation here with ensuring count( $data ) > 1
        fwrite( $ifp, base64_decode( (string)$base64_string) );
    
        // clean up the file resource
        fclose( $ifp ); 
    
        echo $output_file; 
        return null;
    }

         // Комментарии
         function f_za_get_object_notes(){

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

        if( !isset( $name ) || $name == "" ){
            return "Необходимо указать тему задачи.";
        }
        else if( !isset( $task ) || $task == "" ){
            return "Необходимо описать задачу.";
        }
        else if( !isset( $date_start ) || $date_start == ""  ){
            return "Необходимо заполнить дату начала выполнения задачи.";
        }
        else if( !isset( $date_end ) || $date_end == "" ){
            return "Необходимо заполнить дату начала окончания задачи.";
        }
        else if( !isset( $worker ) || $worker == "" ){
            return "Необходимо выбрать исполнителя.";
        }
        else if( !isset( $manager ) || $manager == "" ){
            return "Необходимо выбрать контралера.";
        }
        else if( $date_end < $date_start ){
            return "Дата окончания не может быть меньше даты начала";
        }else{
            return "Задача успешно заведена";
        }
    }

    // Смена состояний
    function f_change_state( $object, $new_state ){

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
                        <function name="f_change_state">
                            <arg name="o_num">'. $object .'</arg>
                            <arg name="new_state">'. $new_state .'</arg>
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


        return $response_xml;
    }


    // ID пользователя
    function f_get_my_id(){

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
                        <function name="f_get_my_id"></function>
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


        return $response_xml;
    }
?>