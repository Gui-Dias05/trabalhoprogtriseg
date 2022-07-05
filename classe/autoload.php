<?php 
spl_autoload_register(function ($class) {
    include 'classe/Class'.$class.'php' ;
});
?>