<!DOCTYPE html>
<html>
    <head>
        <?php include('page_details/head.php'); ?>
        <title>Support</title>
    </head>

    <body>
        <div class="container">
            <div>
                <?php include('page_details/navigation.php'); ?>
            </div>
            <div class="notification is-white" style="">
                <div class="box">
                    <article class="media">
                        <div class="media-content" style="height: auto;">
                            <div class="content">
                                <h2>FOM - Фонд обязательного медицинского страхования КР</h2>
                                <form>
                                    <div class="control">
                                        <textarea class="textarea has-fixed-size" rows="3"></textarea>
                                    </div>
                                    <div class="field" style="margin-top: 10px;">
                                        <p class="control">
                                            <input class="input" type="time" style="width: auto">
                                            <input class="input" type="date" style="width: auto;margin-left: 10px">
                                            <div class="select" style="margin-top: 10px">
                                                <select class="select" style="height: 28px;">
                                                    <option></option>
                                                    <option>D - Documenting</option>
                                                    <option>I - Implementation</option>
                                                    <option>P - Project mgmt </option>
                                                    <option>S - Support </option>
                                                </select>
                                            </div>
                                        </p>
                                        <input class="button" type="submit" value="Записать" style="margin-top: 10px;">
                                    </div>
                                </form>
                                <br>
                                <hr>
                                
                            </div>
                        </div>
                    </article>
                </div>
            </div>

            <div class="footer-div">
                <?php include('page_details/footer.php'); ?>
            </div>
        </div>
    </body>
</html>
