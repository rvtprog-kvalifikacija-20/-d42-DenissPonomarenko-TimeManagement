<?php 
    include_once("functions/functions.php");
    check_session();

    if( isset( $_GET['s'] ) ){
        if( isset( $_GET['u'] ) ){
            $_SESSION['u_id'] = $_GET['u'];
        }
        change_state( $_GET['s'] );
        header("Location: index.php");
    }
?>

<div class="container mt-5 mb-5">
    <?php 
        $response_xml = f_get_user_data();
        $user = $response_xml->{'body'}->{'user'};
    ?>
    <div class="card mb-4 shadow-sm mt-3">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal"><?php echo $user->u_lastname ." ". $user->u_firstname ?></h4>
        </div>
        <div class="card-body">
            <img src="..." class="col-6" alt="..." style="width: 170px">
            <div class="col-21">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item" title="Логин"><?php echo $user->u_login                   ?></li>
                    <li class="list-group-item" title="Пол"><?php echo $user->u_gender                    ?></li>
                    <li class="list-group-item" title="Дата рождения"><?php echo $user->u_birthday        ?></li>
                    <li class="list-group-item" title="Тип пользователя"><?php echo $user->u_type         ?></li>
                    <li class="list-group-item" title="Подразделение"><?php echo $user->u_department      ?></li>
                    <li class="list-group-item" title="Должность"><?php echo $user->u_position            ?></li>
                    <li class="list-group-item" title="Адрес"><?php echo $user->u_addr_country . ', '. $user->u_addr_city . ', ' . $user->u_addr_street       ?></li>
                    <li class="list-group-item" title="Адрес эл. почты"><a href="mailto:<?php echo $user->u_email ?>"><?php echo $user->u_email               ?></a></li>
                    <li class="list-group-item" title="Номер телефона"><a href="tel:<?php echo $user->u_tel_m ?>"><?php echo $user->u_tel_m                   ?></a></li>
                    <li class="list-group-item" title="Заместитель"><a href="index.php?s=user&u=<?php echo $user->u_deputy_id ?>"> <?php echo $user->u_deputy ?></a></li>
                    <li class="list-group-item" title="Описание"><?php echo $user->u_descr ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>