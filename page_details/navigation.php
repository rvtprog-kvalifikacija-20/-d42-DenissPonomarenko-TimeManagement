<?php include( "page_details/head.php" );?>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm" style="display: flex;">
    <h5 class="my-0 mr-md-auto font-weight-normal"><a href="index.php?s=projects">Simourg</a></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="index.php?s=projects">Проекты</a>
        <a class="p-2 text-dark" href="index.php?s=supports">Техподдержка</a>
        <a class="p-2 text-dark" href="index.php?s=tasks">Задачи</a>
        <a class="p-2 text-dark" href="index.php?s=users">Пользователи</a>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php if( isset( $_SESSION["username"] )){ echo $_SESSION["username"]; }else{ echo "Профиль";} ?>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="index.php?s=new_task">Добавить задачу</a>
            <a class="dropdown-item" href="#">*Добавить пользователя*</a>
            <a class="dropdown-item" href="#">*Another action*</a>
            <a class="dropdown-item" href="#">*Another action*</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="exit.php">Выйти</a>
        </div>
    </nav>
</div>