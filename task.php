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
        $response_xml   = f_za_info( $_SESSION['o_num'] );
        $task = $response_xml->{'body'}->{'task'};
    ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal <?php echo get_object_color( $task->o_ind_id )?>">
                <?php 
                    if( empty( $task->o_name ) ){
                        echo 'Ошибка'; 
                    }else{ 
                        echo $task->o_name; 
                    }  
                ?>
                <p class="float-right"><?php echo $task->o_hist_time ?></p>
            </h4>
        </div>
        <div class="card-body">
            <div style="display: inline;">
                <button type="button" class="btn btn-outline-success btn-sm">Завершить</button>
                <button type="button" class="btn btn-outline-danger btn-sm">Доработать</button>
            </div>
            <hr>
            <ul class="list-unstyled mb-4">
                <li>Регистратор  <a href="index.php?s=user&u=<?= $task->o_creator_id ?>"><?php echo $task->o_creator?></a></li>
                <li>Контролёр    <a href="index.php?s=user&u=<?= $task->o_manager_id ?>"><?php echo $task->o_manager?></a></li>
                <li>Исполнитель  <a href="index.php?s=user&u=<?= $task->o_performer_id ?>"><?php echo $task->o_performer?></a></li>
                <li>Состояние    <?php echo $task->o_state ?></li>
                <hr>
                <li>Дата начала    <?php echo $task->o_date_start ?></li>
                <li>Дата окончания <?php echo $task->o_date_end ?></li>
                <hr>
                <p><?php echo $task->o_description ?></p>
            </ul>
            <?php include_once("page_details/comment.php") ?>
            <hr>
            <?php include_once("page_details/notes.php") ?>
        </div>
    </div>
</div>