            <footer class="container" style="margin-top: 5%; <?php if( $_SESSION['state'] == 'error' ){ echo 'margin-top: 17%'; }?>">
                <?php if( $_SESSION['state'] <> 'login' ){ echo '<p class="float-right"><a href="#">Back to top</a></p>'; } ?>
                <p>© 2003-2020 Simourg company. · <a href="https://www.simourg.com/" target="_blank">Simourg</a> · <a href="https://sim.simbase.eu/" target="_blank">SimBASE</a> · <a href="mailto:support@simourg.com">Support</a> · <a href="https://demo.simbase.eu/" target="_blank">Demo</a></p>
            </footer>
        </div>
    </body>
</html>