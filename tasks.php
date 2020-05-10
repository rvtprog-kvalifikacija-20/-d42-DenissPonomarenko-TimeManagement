<?php 
    include_once("functions/functions.php");
    check_session();

    if( isset( $_GET['s'] ) ){
        if( $_GET['s'] == 'task' ){
            $_SESSION['o_num'] = $_GET['task'];
        }
        if( $_GET['s'] == 'user' ){
            $_SESSION['u_id'] = $_GET['u'];
        }

        change_state( $_GET['s'] );
        header("Location: index.php");
    }
?>


<div class="container mt-5 mb-5">
    <h3 class="my-0 font-weight-normal mb-3">Задачи</h3>
    <?php 
        $response_xml   = f_za_my_tasks();
        echo $response_xml;
        $object_numbers = $response_xml->{'body'}->{'task'};
        foreach( $object_numbers as $k => $v ) :
    ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <a class="<?php echo get_object_color( $v->o_ind_id )?>" href="index.php?s=task&task=<?php echo $v->o_num ?>"><h4 class="my-0 font-weight-normal"><?php echo $v->o_name ." - ". $v->o_num ?></h4></a>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Контролёр   <a href="index.php?s=user&u=<?= $v->o_manager_id ?>"><?php echo $v->o_manager?></a></li>
                        <hr>
                        <li>Дата начала  <?php echo $v->o_date_start ?></li>
                        <li>Дата окончания   <?php echo $v->o_date_end ?></li>
                        <hr>
                        <li>Процент выполнения <?php echo $v->o_progress_bar ?>%</li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
</div>