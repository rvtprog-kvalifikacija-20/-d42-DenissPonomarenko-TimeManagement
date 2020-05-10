<?php 
    include_once("functions/functions.php");
    check_session();

    if( isset( $_GET['s'] ) ){
        if( $_GET['s'] == 'task' ){
            $_SESSION['o_num'] = $_GET['task'];
        }
        if( $_GET['s'] == 'support' ){
            $_SESSION['s_num'] = $_GET['s_num'];
        }

        change_state( $_GET['s'] );
        header("Location: index.php");
    }

    $response_xml = f_zs_support_data();
    echo $response_xml;
    $support = $response_xml->{'body'}->{'sup'};
?>

<div class="container mt-5 mb-5">
    <div class="card mb-4 shadow-sm">
        <div class="card-header">
            <h4 class="my-0 font-weight-normal <?php echo get_object_color( $support->o_ind_id )?>"> <?php echo $support->o_name ?> </h4>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mt-3 mb-4">
                <li><?php echo $support->o_client ?></li>
                <br>
                <li><?php echo $support->o_description ?></li>
            </ul>
            <hr>
            <?php include_once("page_details/comment.php") ?>
        </div>
        </div>
    </div>
</div>