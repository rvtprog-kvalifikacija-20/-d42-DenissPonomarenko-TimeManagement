<?php 

    if( isset( $_GET['s'] ) ){
        if( $_GET['s'] == 'event' ){
            $_SESSION['o_num'] = $_GET['o_num'];
        }
    }

    $response_xml = f_get_event_data( $_SESSION['o_num'] );
    $event = $response_xml->{'body'}->{'event'};
?>

<div class="container mt-5 mb-5">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal <?php echo $event->o_ind_id ?>">
                <?php echo $event->o_name?> 
                <p class="float-right"><?php echo $event->o_hist_time ?></p>
            </h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-4">
                <li>Руководитель  <a href="index.php?s=user&u=<?= $event->o_performer_id ?>"><?php echo $event->o_performer?> </a></li>
                <li>Состояние     <?php echo $event->o_state ?></li>
                <hr>
                <li>Дата начала    <?php echo $event->o_date_start ?></li>
                <li>Дата окончания <?php echo $event->o_date_end ?></li>
                <hr>
                <li>Выполнено      <?php echo $event->o_progress_bar ?>%</li>
            </ul>
            <?php include_once("page_details/comment.php"); ?>
            <?php include_once("page_details/notes.php");   ?>
        </div>
    </div>
</div>