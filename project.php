<?php 

    if( isset( $_GET['s'] ) ){
        if( $_GET['s'] == 'project' ){
            $_SESSION['o_num'] = $_GET['o_num'];
        }
    }
    $response_xml = f_zs_project_data( $_GET['o_num'] );
    $project = $response_xml->{'body'}->{'project'};
?>

<div class="container mt-5 mb-5">
    <div class="card mb-2 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal"><?php echo $project->o_name?></h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mt-3 mb-2">
            <li>Руководитель <a href="index.php?s=user&u=<?= $project->o_manager_id ?>"><?php echo $project->o_manager?></a></li>
                <li>Исполнитель  <a href="index.php?s=user&u=<?= $project->o_worker_id ?>"><?php echo $project->o_worker?></a></li>
                <hr>
                <li>Дата начала  <?php echo $project->o_date_start ?></li>
                <li>Завершить до <?php echo $project->o_date_wend ?></li>
                <li>Дата сдачи   <?php echo $project->o_date_end ?></li>
                <hr>
                <?php
                    if( !empty($project->o_description) ){
                        echo '<li class="mb-2">Описание</li>';
                        echo '<li>'. $project->o_description . '</li>';
                        echo '<hr>';
                    }
                ?>
            </ul>
        </div>
        <?php 
            if( !empty( $project->o_events->event ) ){
                echo '<h6 class="my-0 font-weight-normal ml-4 mb-2">Мероприятия</h6>';
                echo '<ol class="mb-4">';
                foreach( $project->o_events->event as $key => $event ){
                    echo '<li><a href="index.php?s=event&o_num='. $event->event_num .'">'. $event->event_num .' - '. $event->event_name .' </li>';
                }
                echo '</ol>';
            }
        ?>
    </div>
</div>
