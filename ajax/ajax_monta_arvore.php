<?php

if (!empty($_POST['pastas_anteriores'])) {

    $pastas_anteriores = $_POST['pastas_anteriores'];

    for ($i = 0; $i < count($pastas_anteriores); $i++) {
        $pasta = explode('/', base64_decode($pastas_anteriores[$i]));
        if($i == 0){
        echo '<a href="#" id="'.$i.'" class="nav">Raiz</a><br>';
        }else{
         echo '<a href="#" id="'.$i.'"style="margin-left:'.($i*5).'px;" class="nav">&gt;' . $pasta[count($pasta) - 1] . '</a><br>';   
        }
    }
}

