<?php include_once("page_details/head.php") ?>
<div class="container login-container" style="margin-top: 10%">
    <div class="row mt-5">
        <div class="col-md-6 login-form-1">
            <h3 class="text-left ml-5 mb-0">Вход в систему</h3>
            <form action="check.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="login" 
                        <?php 
                            if( isset( $_SESSION['username'] ) ){
                                echo 'value="'.$_SESSION['username'].'"';
                            }else{ 
                                echo 'placeholder="Логин"'; 
                            }
                        ?> 
                    required/>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Пароль" value="" required/>
                </div>
                <div class="text-danger">
                    <?php if( isset( $_SESSION["login_error"] )){ echo $_SESSION["login_error"]; } ?>
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" name="submit" value="Войти" />
                </div>
            </form>
        </div> 
        
        <div class="col-md-6 login-form-2">
            <div class="half ml-3">
                <h4>СОВРЕМЕННЫЕ РЕШЕНИЯ ДЛЯ БИЗНЕСА</p>
                <br>
                <h4>ПРЕДОСТАВЛЕНИЕ КОНСУЛЬТАЦИЙ</p>
                <br>
                <h4>ТРЕНИНГИ И ОБУЧЕНИЕ</p>
            </div>
        </div> 
    </div>


