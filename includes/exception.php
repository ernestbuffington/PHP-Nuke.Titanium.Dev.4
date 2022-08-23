<?php

/* -- -----------------------------------------------------------
 * // Nuke-Evolution Xtreme: Enhanced PHP-Nuke Web Portal System
 * -- -----------------------------------------------------------
 *
 * >> Core
 *
 * @filename    exception.php
 * @author      Travo, SgtLegend
 * @version     0.1
 * @date        Oct 6, 2012
 * @notes       Exception handler function
 *
 * -- -----------------------------------------------------------
 * // Legal Stuff
 * -- -----------------------------------------------------------
 *
 * (c) Copyright 2000-11 Francisco Burzi
 * http://www.phpnuke.org
 *
 * This program is free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the license.
 */

function printException(Throwable $e) {
	ob_end_clean();
    ?>
    <!doctype html>
    <html>
    <head>
        <title>An uncaught exception has occurred</title>
        <meta charset="utf-8">
        <style>
            html {
                background-color: #eee;
                min-width: 990px;
                padding: 0 20px;
            }

            body {
                background-color: #fff;;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, .1);
                font: 15px/17px 'Helvetica Neue', Helvetica, Arial, sans-serif;
                margin: 39px auto 0;
                max-width: 1400px;
                min-width: 950px;
            }

            body:before {
                background-color: #333;
                border-bottom: 1px solid #fff;
                box-shadow: inset 0 0 10px rgba(0, 0, 0, .7);
                content: '';
                display: block;
                height: 100px;
                left: 0;
                position: absolute;
                top: 0;
                width: 100%;
                z-index: -1;
            }

            h1 {
                background-color: #fbfbfb;
                border-bottom: 1px solid #fff;
                border-radius: 5px 5px 0 0;
                color: #444;
                font-size: 20px;
                font-weight: normal;
                line-height: 20px;
                margin: 0;
                padding: 20px 0;
                position: relative;
                text-align: center;
                z-index: 1;
            }

            dl {
                border-top: 1px solid #ccc;
                margin: 0;
                overflow: hidden;
                padding: 20px;
            }

            dt {
                float: left;
                font-weight: bold;
                padding-left: 10px;
                width: 150px;
            }

            dd {
                margin-left: 220px;
                padding-right: 10px;
            }

            #trace {
                padding-bottom: 10px;
            }

            #trace ul {
                list-style: none;
                margin: 0;
                padding: 0;
            }

            #trace li {
                background-color: #eee;
                border-radius: 5px;
                margin-bottom: 10px;
                overflow: hidden;
                position: relative;
            }

            #trace strong {
                background-color: #ccc;
                border-radius: 5px 0 0 5px;
                color: #000;
                display: block;
                height: 100%;
                line-height: 26px;
                left: 0;
                padding: 0 14px;
                position: absolute;
            }

            #trace p {
                float: left;
                margin: 0 0 0 50px;
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>

        <h1>Uncaught <strong><?php echo (defined(get_class($e) . '->EXCEPTION_NAME') ? $e->EXCEPTION_NAME . ' ' : ''); ?></strong>Exception Has Occurred!</h1>
        <dl>
            <dt>Message:</dt>
            <dd><?php echo $e->getMessage(); ?></dd>
        </dl>
        <dl>
            <dt>File:</dt>
            <dd><em><?php echo $e->getFile(); ?></em></dd>
        </dl>
        <dl>
            <dt>Line:</dt>
            <dd><?php echo $e->getLine(); ?></dd>
        </dl>
        <dl id="trace">
            <dt>Stack Trace:</dt>
            <dd>
                <ul><li>
                <?php

                $trace = explode("\n", $e->getTraceAsString());

                foreach ($trace as $k => $v) {
                    $trace[$k] = preg_replace('/^\#([\d]+) /', '<strong>#$1</strong><p>', $v);
                }

                echo join('</p></li><li>', array_reverse($trace));

                ?>
                </p></li></ul>
            </dd>
        </dl>

    </body>
    </html>
    <?php
}

set_exception_handler('printException');