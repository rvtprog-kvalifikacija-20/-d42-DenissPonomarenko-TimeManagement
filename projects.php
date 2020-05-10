<?php 
    include_once("functions/functions.php");
    check_session();
    
    if( isset( $_GET['s'] ) ){
        change_state( $_GET['s'] );
        header("Location: index.php");
    }
?>
<div class="container mt-5 mb-5">
<h3 class="my-0 font-weight-normal mb-3">Проекты</h3>
    <?php 
    
        $projects = array( array("KDB: P01 - Внедрение SimBASE", "Aleksandr Evsigneev" , "Нурлан Абишев", "23.09.2019", "31.08.2020", "23.09.2020", "59"),
        array("BTR: P02 - Автоматизация бизнес-процессов", "Timofey Kostogryzov" , "Timofey Kostogryzov", "07.01.2020", "15.12.2020", "20.12.2020", "100"),
        array("MFI: P01 - Audita sistēma revīzijas iestādes darbiniekiem", "Andrey Kuznetsov" , "Aleksandr Evsigneev", "11.08.2015", "01.12.2015", "15.12.2015", "100"),
        array("KIC: P02 - Автоматизация бизнес-процессов", "Timofey Kostogryzov" , "Timofey Kostogryzov", "27.03.2020", "14.12.2020", "29.12.2020", "50"),
        array("MDG: P01 - Re-engineering of MD public services", "Andrey Kuznetsov" , "Aleksandr Evsigneev", "24.07.2019", "15.09.2020", "30.09.2020", "0"),
        ); 
        for( $i = 0; $i < count( $projects ); $i++):
    ?>
        <div class="card mb-4 shadow-sm">
            <div class="card-header">
                <a href="project.php"><h4 class="my-0 font-weight-normal"><?php echo $projects[$i][0]?></h4></a>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mt-3 mb-4">
                    <li>Руководитель <a href="#"><?php echo $projects[$i][1]?></a></li>
                    <li>Исполнитель  <a href="#"><?php echo $projects[$i][2]?></a></li>
                    <br>
                    <li>Дата начала  <?php echo $projects[$i][3]?></li>
                    <li>Завершить до <?php echo $projects[$i][4]?></li>
                    <li>Дата сдачи   <?php echo $projects[$i][5]?></li>
                    <br>
                    <li>Процент выполнения <?php echo $projects[$i][6]?>%</li>
                </ul>
            </div>
        </div>
    <?php endfor;?>
</div>