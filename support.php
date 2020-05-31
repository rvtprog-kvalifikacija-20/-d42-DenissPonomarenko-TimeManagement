<?php 
    check_session();

    if( isset( $_GET['s'] ) ){
        if( $_GET['s'] == 'support' ){
            $_SESSION['o_num'] = $_GET['o_num'];
        }
    }

    $response_xml = f_zs_support_data();
    echo $response_xml;
    $support = $response_xml->{'body'}->{'sup'};
?>

<div class="container mt-5 mb-5">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal <?php echo $support->o_ind_id ?>"> 
                <?php 
                    if( empty( $support->o_name ) ){
                        echo 'Ошибка'; 
                        $_SESSION['state'] = 'error';
                        header("Location: /");
                    }else{ 
                        echo $support->o_name; 
                    }  
                ?>
                <p class="float-right"><?php echo $support->o_hist_time ?></p>
            </h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
                <li><?php echo $support->o_client ?></li>
                <br>
                <li><?php echo $support->o_description ?></li>
            </ul>
            <?php include_once("page_details/comment.php") ?>
            <hr>
            <?php //include_once("page_details/notes.php") ?>
        </div>
    </div>
</div>