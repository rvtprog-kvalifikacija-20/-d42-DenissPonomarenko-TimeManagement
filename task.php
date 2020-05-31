<div class="container mt-5 mb-5">
    <?php 
        $response_xml   = f_za_info( $_SESSION['o_num'] );
        $task = $response_xml->{'body'}->{'task'};
    ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal <?php echo $task->o_ind_id ?>">
                <?php 
                    if( empty( $task->o_name ) ){
                        echo 'Ошибка'; 
                        $_SESSION['state'] = 'error';
                        header("Location: /");
                    }else{ 
                        echo $task->o_name; 
                    }  
                ?>
                <p class="float-right"><?php echo $task->o_hist_time ?></p>
            </h4>
        </div>
        <div class="card-body">
            <div style="display: inline;">
                <?php
                    switch ( $task->o_state ) {
                        case "Новое":
                            echo '<a href="change_state.php?new_state=9190"><button type="submit" class="btn btn-outline-success btn-sm">На выполнение</button></a>';
                            echo '<hr>';
                            break;
                        case "Контроль":

                            if( $task->o_manager_id == $_SESSION['user_id'] || $_SESSION['user_id'] == $task->u_deputy ){
                                echo '<a href="index.php?s=change_state&new_state=9192"><button type="submit" class="btn btn-outline-success btn-sm">Выполнено</button></a>';
                                echo '<a href="index.php?s=change_state&new_state=9190"><button type="submit" class="btn btn-outline-danger btn-sm ml-2">На доработку</button></a>';
                                echo '<hr>';
                            }
                            break;
                        case "Выполнение задания":
                            if( $task->o_performer_id == $_SESSION['user_id'] || $_SESSION['user_id'] == $task->u_deputy ){
                                echo '<a href="index.php?s=change_state&new_state=9191"><button type="submit" class="btn btn-outline-success btn-sm">Завершить</button></a>';
                                echo '<hr>';
                            }
                            break;
                    }

                ?>
            </div>

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
            <?php 
                if( $task->o_state == "Выполнение задания" && $task->o_performer_id == $_SESSION['user_id'] || $task->o_state == "Выполнение задания" && $_SESSION['user_id'] == $task->u_deputy ){
                    include_once("page_details/comment.php");
                }          
            ?>
            <?php 
                if( $task->o_state <> "Новое" ){
                    include_once("page_details/notes.php");
                }
            ?>
        </div>
    </div>
</div>