<?php 
    include_once("functions/functions.php");
    check_session();

    if( isset( $_GET['s'] ) ){
        if( $_GET['s'] == 'task' ){
            $_SESSION['o_num'] = $_GET['task'];
        }
        if( $_GET['s'] == 'support' ){
            $_SESSION['o_num'] = $_GET['o_num'];
        }

        change_state( $_GET['s'] );
        header("Location: index.php");
    }
?>

<div class="container mt-5 mb-5">
    <h3 class="my-0 font-weight-normal mb-3">Техподдержка</h3>
    <?php 
        $response_xml   = f_zs_support_list();
        $support_list = $response_xml->{'body'}->{'support'};
        foreach( $support_list as $k => $v ) :
    ?>
        <div class="card mb-4 shadow-sm" style="width: 100%; display: inline-block">
            <div class="card-header">
            <a href="index.php?s=support&o_num=<?php echo $v->o_num ?>"><h4 class="my-0 font-weight-normal"><?php echo $v->o_client ?></h4></a>
            </div>
        </div>
    <?php endforeach;?>
</div>
