<?php 
    include_once("../functions/functions.php");
    check_session();

    if( isset( $_GET['write'] ) ){

        f_za_make_note( $_SESSION['o_num'], $_GET['text'], $_GET['type'], $_GET['time']);
        header("Location: /");
    }
?>

<div class="col-md-12 order-md-1">

    <form class="needs-validation" action="#" novalidate="" method="get">

        <div class="row">
            <div class="col-md-12 mb-3">
                <textarea class="form-control" name="text" rows="3" placeholder="Результат" required></textarea>
            </div>
        </div>
        <div class="row">
            
            <div class="col-md-3 mb-3">
                <input type="time" class="form-control" name="time" required>
            </div>
        
            <div class="col-md-3 mb-3">
                <select class="custom-select d-block w-100" required="" name="type" required>
                    <option value="" required></option>
                    <?php
                        $response_xml   = get_notes( 'f_za_my_tasks' );
                        $object_numbers = $response_xml->{'body'}->{'note'};
                        foreach( $object_numbers as $k => $v ) :
                            echo '<option value="'.$v->note_code.'">'.$v->note_name.'</option>';
                        endforeach;
                    ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="text-danger mb-2 ml-3">
                <?php if( isset( $_SESSION["comment_status"] )){ echo $_SESSION["comment_status"]; } ?>
            </div>
            <div class="col-md-12 mb-3">
                <button type="submit" class="btn btn-primary" name="write">Записать</button>
            </div>
        </div>
    </form>
</div>
