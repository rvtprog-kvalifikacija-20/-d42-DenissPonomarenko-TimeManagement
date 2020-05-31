<?php
    include_once("../functions/functions.php");
    $response_xml = f_za_get_object_notes();
    $notes = $response_xml->{'body'}->{'note'}; 
    if( !isset( $notes->{'date'} ) ){
        return 0;
    }else{
        
?>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Дата</th>
            <th scope="col">Комментарий</th>
            <th scope="col">Автор</th>
            <th scope="col">Тип</th>
        </tr>
    </thead>
    <tbody>
    <?php 
        foreach( $notes as $k => $note ) :
    ?>
        <tr>
            <td><?php echo $note->date ?></td>
            <td><?php echo $note->text ?></td>
            <td><a href="index.php?s=user&u=<?php echo $note->user_id ?>"><?php echo $note->user?></a></td>
            <td><?php echo $note->type ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
        <?php } ?>