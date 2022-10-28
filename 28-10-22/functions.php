<?php
    function fibo($pos) {
        if($pos === 0) {
            return 0;
        }

        if($pos === 1 || $pos === 2) {
            return 1;
        } 
        
        if($pos === 3) {
            return 2;
        }
            
        return fibo($pos - 1) + fibo($pos - 2);
    }

    function createHead ($title) {
        print <<<END
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>$title</title>
            </head>
        END;
    }
?>