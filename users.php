<div class="container mt-5 mb-5">
    <h3 class="my-0 font-weight-normal mb-3">Пользователи</h3>
    <?php 
        $response_xml   = f_za_select_users();
        echo $response_xml;
        $object_numbers = $response_xml->{'body'}->{'user'};
        foreach( $object_numbers as $k => $v ) :
    ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <a href="index.php?s=user&u=<?php echo $v->u_id ?>"><h4 class="my-0 font-weight-normal"><?php echo $v->u_firstname ." ". $v->u_lastname ?></h4></a>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                        <li><?php echo $v->u_type ?></li>
                        <li><?php echo $v->u_department ?></li>
                        <li><?php echo $v->u_position ?></li>
                        <hr>
                        <li><a href="mailto:<?php echo $v->u_email ?>"><?php echo $v->u_email ?></a></li>
                        <li><a href="tel:<?php echo $v->u_tel ?>"><?php echo $v->u_tel ?></a></li>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
</div>