<?php

foreach (glob(__DIR__ . "/platform/*.php") as $file)
    require $file;