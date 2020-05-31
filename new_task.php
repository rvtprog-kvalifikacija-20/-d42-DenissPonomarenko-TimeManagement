<div class="container mt-5 mb-5">
    <div class="col-md-12 order-md-1">

        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <h4 class="my-0 font-weight-normal">Новая задача</h4>
            </div>
            <div class="card-body">
            <form class="needs-validation" action="check.php" novalidate="" method="post">

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <input id="o_name" type="text" class="form-control" name="o_name" 
                        <?php 
                            if( isset( $_SESSION['new_task_name'] ) && $_SESSION['new_task_name'] != "" ){
                                echo 'value="'.$_SESSION['new_task_name'].'"';
                            }else{ 
                                echo 'placeholder="Тема"'; 
                            }
                        ?> 
                        required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <textarea class="form-control" name="task" rows="3"
                        <?php 
                            if( !isset( $_SESSION['new_task_description'] ) || $_SESSION['new_task_description'] == "" ){
                                echo 'placeholder="Описание задачи"'; 
                            }
                        ?> 
                        required><?php if( isset( $_SESSION['new_task_description'] ) &&  $_SESSION['new_task_description'] != "" ){ echo $_SESSION['new_task_description'];} ?></textarea>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-3 mb-3">
                        <label for="o_date_start">Дата начала</label>
                        <input id="o_date_start" type="date" class="form-control" name="date_start"
                        <?php 
                            if( isset( $_SESSION['new_task_date_start'] ) ){
                                echo 'value="'.$_SESSION['new_task_date_start'].'"';
                            }
                        ?> 
                        required>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label for="o_date_end">Дата окончания</label>
                        <input id="o_date_end" type="date" class="form-control" name="date_end" 
                        <?php 
                            if( isset( $_SESSION['new_task_date_end'] ) ){
                                echo 'value="'.$_SESSION['new_task_date_end'].'"';
                            }
                        ?> 
                        required>
                    </div>
                
                    <div class="col-md-3 mb-3 col-6">
                        <label for="o_performer">Исполнитель</label>
                        <select id="o_performer" class="custom-select d-block w-100" required="" name="worker" required>
                            <option value="" required></option>

                            <?php
                                $response_xml   = f_za_select_users();
                                $users = $response_xml->{'body'}->{'user'};
                                foreach( $users as $k => $v ) :
                                    echo '<option value="'.$v->u_id.'">'.$v->u_firstname .' '. $v->u_lastname .'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3 col-6">
                        <label for="o_performer">Контролёр</label>
                        <select id="o_performer" class="custom-select d-block w-100" required="" name="manager" required>
                            <option value="" required></option>
                            <?php
                                $response_xml   = f_za_select_users();
                                $users = $response_xml->{'body'}->{'user'};
                                foreach( $users as $k => $v ) :
                                    echo '<option value="'.$v->u_id.'">'.$v->u_firstname .' '. $v->u_lastname .'</option>';
                                endforeach;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <?php 
                        if( $_SESSION['new_task_error'] == "Задача успешно заведена" ){ 
                            echo '<div class="text-success mb-1 ml-3">';
                                echo  $_SESSION['new_task_error'];
                            echo '</div>';
                        }else{
                            echo '<div class="text-danger mb-1 ml-3">';
                                echo $_SESSION['new_task_error'];
                            echo '</div>';
                        }  
                        
                        $_SESSION['new_task_error'] = '';
                    ?>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary" name="add">Создать</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>