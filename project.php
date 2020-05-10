<?php 
    include_once("functions/functions.php");
    check_session();
?>

<!DOCTYPE html>
<html lang="ru">
    <?php include_once("page_details/head.php") ?>
    <title>KDB: P01 - Внедрение SimBASE</title>
    <body>
        <?php include_once("page_details/navigation.php") ?>

        <div class="container mt-5 mb-5">
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">KDB: P01 - Внедрение SimBASE</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mt-3 mb-4">
                        <li>Руководитель <a href="#">Aleksandr Evsigneev</a></li>
                        <li>Исполнитель  <a href="#">Нурлан Абишев</a></li>
                        <br>
                        <li>Дата начала   23.09.2019</li>
                        <li>Завершить до  31.08.2020</li>
                        <li>Дата сдачи    23.09.2020</li>
                        <br>
                        <li>Общий процент выполнения 59%</li>
                    </ul>
                </div>
                <h6 class="my-0 font-weight-normal ml-4">Список задач</h6>
                <ol class="mb-4">
                    <?php 
                        $array = array( "Настройка отчета - ''Статистический отчет по движению персонала'' (ZU2004060E)", "Настройка отчета - ''Качественный состав'' (ZU2004060G)" );
                        for( $i = 0; $i < count( $array ); $i++ ):
                    ?>
                        <li><a href="task.php"><?php echo $array[$i] ?></a></li>
                    <?php endfor; ?>
                </ol>
            </div>
        </div>

        <?php include_once("page_details/footer.php") ?>

    </body>
</html>