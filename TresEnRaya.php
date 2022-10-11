<?php
$mapa = array(
    array(" "," "," "),
    array(" "," "," "),
    array(" "," "," ")
); 
$turno = 0;
function comprobarVictoria($campo,$tipo,$fila):bool
{
    $vuelta = false;
    $horiz = array_filter($campo[$fila], fn($valor) => $valor == $tipo ? $valor : " "); 
    $vuelta = $horiz[0] == $tipo && $horiz[1] == $tipo && $horiz[2] == $tipo ? true : false;
    return $vuelta;
}
$ronda = 0;
$valido = true;
function pintarTablero($mapa){
    echo   "\n
    +-----+-----+-----+
    |  ".$mapa[0][0]."  |  ".$mapa[0][1]."  |  ".$mapa[0][2]."  |
    +-----+-----+-----+
    |  ".$mapa[1][0]."  |  ".$mapa[1][1]."  |  ".$mapa[1][2]."  |
    +-----+-----+-----+
    |  ".$mapa[2][0]."  |  ".$mapa[2][1]."  |  ".$mapa[2][2]."  |
    +-----+-----+-----+
    \n"  ;
}
do {
    echo "Tres en ralla \n";
    pintarTablero($mapa);
    echo $turno == 0 ? "Turno del jugador:X" : "Turno del jugador:O";
    echo "\n";
    
    fscanf(STDIN,"%d %d", $i,$j);
    if ($j<3 &&$j>=0 &&$i<3 && $i>=0 && $mapa[$i][$j]==" ") {
        
        if ($turno == 0 ) {
            $mapa[$i][$j] = "X";
        } else if ($turno == 1 ) {
            
            $mapa[$i][$j] = "O";
        }
        $letra = $turno == 0 ? "X" : "O";
        //echo "Alguien ha ganado? -> ".comprobarVictoria($mapa,$letra);
        $ganado = comprobarVictoria($mapa,$letra,$i);
        $ganado?$valido = false : $valido = true;
        /**
         * Cambio el turno para que juegue el rival contrario
         * 0 = X
         * 1 = O
         */
        $turno = $turno == 0? 1 : 0;
        $ronda++;
    }
    if ($ganado) {
        pintarTablero($mapa);
        echo "Ha ganado el jugador $letra";
    }else if ($ronda == 9) {
        echo "Empate!";
        $valido = false;
    }
} while ($valido);
