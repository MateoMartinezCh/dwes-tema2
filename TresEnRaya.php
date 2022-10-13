<?php
$mapa = array(
    array(" "," "," "),
    array(" "," "," "),
    array(" "," "," ")
); 
$turno = 0;
function comprobarVictoria($campo,$tipo,$fila,$columna):bool
{
    /*
     * Si devuelve falso significa que nadie ha ganado, si devuelve verdadero ha encontrado una jugada ganadora
     */
    $vuelta = false;
    /*
        En horiz obtenemos de la matriz, el array horizontal necesario para comprobar si en ese turno alguien ha conseguido la victoria
        y compruebahorizontales es un booleano que hará que si es verdadero se convierta vuelta a verdadero.
    */
    $horiz = array_filter($campo[$fila], fn($valor) => $valor == $tipo ? $valor : " "); 
    $compruebahorizontales = $horiz[0] == $tipo && $horiz[1] == $tipo && $horiz[2] == $tipo ? true : false;

    /*
        En verti hacemos todo directamente y verti ya será el comprobador de la columna
    */
    $verti = $campo[0][$columna] == $tipo && $campo[1][$columna] == $tipo && $campo[2][$columna] == $tipo? true : false;
    /*
             
     */
    $diago1 = $campo[0][0] == $tipo && $campo[1][1] == $tipo && $campo[2][2] == $tipo ? true : false;
    $diago2 = $campo[0][2] == $tipo && $campo[1][1] == $tipo && $campo[2][0] == $tipo ? true : false;
    if ($compruebahorizontales || $verti || $diago1 || $diago2) {
        $vuelta = true;
    }
    return $vuelta;
}
$ronda = 0;
$valido = false;
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
    //pido las variables por teclado y las guardo en $i y en $j
    fscanf(STDIN,"%d %d", $i,$j);
    if ($j < 3 && $j >= 0 && $i < 3 && $i >= 0 && !is_null($i) && !is_null($j) && $mapa[$i][$j] == " ") {
        
        $turno == 0 ? $mapa[$i][$j] = "X" : $mapa[$i][$j] = "O";
        $letra = $turno == 0 ? "X" : "O";
        //echo "Alguien ha ganado? -> ".comprobarVictoria($mapa,$letra);
        $valido = comprobarVictoria($mapa,$letra,$i,$j);
        /**
         * Cambio el turno para que juegue el rival contrario
         * 0 = X
         * 1 = O
         */
        $turno = $turno == 0 ? 1 : 0;
        $ronda++;
    }
    //Si se ha ganado la partida ponemos por pantalla el tablero y quién ha ganado
    if ($valido) {
        pintarTablero($mapa);
        echo "Ha ganado el jugador: $letra";

    //si se llega a la última ronda se pinta el tablero, se sale del do while y se acaba el juego en empate
    }else if ($ronda == 9) {
        pintarTablero($mapa);
        echo "Empate!";
        $valido = true;
    }
    //reinicio valores para no tener problemas con números anteriores.
    $i = null;
    $j = null;
} while ($valido == false);
