<?php
    function DiGui($n)
    {
        $array = array(1,2,3,4,5,6,7);
        while($n){
            switch ($n > 1) {
                case '1':
                    # code...
                    echo 4;die;
                    break;
                
                default:
                    # code...
                    break;
            }
        }
    }
    function DiTui()
    {

    }
echo DiGui(2);