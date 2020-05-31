<?php 
    unset($_SESSION['login_error']);
    unset($_SESSION['last_login']);
?>
<div class="container mt-5 mb-5">
    <h3 class="my-0 font-weight-normal mb-3">Проекты</h3>
    <?php 
        $response_xml   = f_zs_project_list();
        $projects = $response_xml->{'body'}->{'project'};
        foreach( $projects as $key => $project ) {
    ?>
    <div class="card mb-4 shadow-sm">

        <div class="card-header">
            <a href="index.php?s=project&o_num=<?php echo $project->o_num ?>"><h4 class="my-0 font-weight-normal"><?php echo $project->o_name ?></h4></a>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
                <li>Руководитель <a href="index.php?s=user&u=<?= $project->o_manager_id ?>"><?php echo $project->o_manager?></a></li>
                <li>Исполнитель  <a href="index.php?s=user&u=<?= $project->o_worker_id ?>"><?php echo $project->o_worker?></a></li>
                <hr>
                <li>Дата начала  <?php echo $project->o_date_start ?> </li>
                <li>Завершить до <?php echo $project->o_date_wend ?>  </li>
                <li>Дата сдачи   <?php echo $project->o_date_end ?>   </li>
                <hr>
                <li>Выполнено <?php echo $project->o_progress_bar ?>%</li>
            </ul>
        </div>
    </div>
        <?php }?>
</div>