<?php

    spl_autoload_register(function($className){
        $basePath = __DIR__ . "/App/";
        $prefix = "App\\";

        $len = strlen($prefix);

        if(substr_compare($className, $prefix, 0, $len) !== 0){
            return;
        }

        $relativeClass = substr($className, $len);
        $relativePath = str_replace('\\', '/', $relativeClass);

        $extensions = ['.class.php', '.php'];

        foreach($extensions as $extension){
            $file = $basePath . $relativePath . $extension;
            if(file_exists($file)){
                require_once $file;
                return;
            }
        }
        
        });