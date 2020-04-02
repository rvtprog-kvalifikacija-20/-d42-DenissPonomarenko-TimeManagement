<section class="login">
    <div class="columns">
        <div class="column is-half">
            <h1 class="title is-2">SIMOURG</h1>
            <div>
                <br>
                <div><span class="subtitle is-4"> СОВРЕМЕННЫЕ РЕШЕНИЯ ДЛЯ БИЗНЕСА </span></div>
                <br>
                <div><span class="subtitle is-4"> ПРЕДОСТАВЛЕНИЕ КОНСУЛЬТАЦИЙ </span></div>
                <br>
                <div><span class="subtitle is-4"> ТРЕНИНГИ И ОБУЧЕНИЕ</span></div>
            </div> 
        </div>

        <div class="column">
            <div class="box">
                <form action="projects.php" method="post">
                    <div class="notification">
                        <h1 class="title is-4">Вход в систему</h1>
                        <div class="field">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input" type="text" name="login" placeholder="Логин" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-user"></i>
                                </span>
                                <span class="icon is-small is-right">
                                    <i class="fas fa-check"></i>
                                </span>
                            </p>
                        </div>
                        <div class="field is-one-quarter">
                            <p class="control has-icons-left has-icons-right">
                                <input class="input" type="password" name="password" placeholder="Пароль" required>
                                <span class="icon is-small is-left">
                                    <i class="fas fa-lock"></i>
                                </span>
                                <span class="icon is-small is-right">
                                    <i class="fas fa-check"></i>
                                </span>
                                <p class="help is-danger">Пользователь не найден</p>
                            </p>
                        </div>
                        <input class="button" type="submit" value="Войти">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>