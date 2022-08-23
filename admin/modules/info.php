<!DOCTYPE html>
<html>
    <head>
        <title>PHP Settings</title>
    </head>
    <body>
        <?php
            ob_start();
            phpinfo(INFO_MODULES);
            echo ob_get_clean();
        ?>
    </body>
</html>