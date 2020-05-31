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
