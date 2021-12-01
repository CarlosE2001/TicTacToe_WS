<?php


class TicTacToe {
	private $nombre = '';
	private $ultimo_saludo = '';
    private $prueba = -1;
    private $tablero = array(-1,-1,-1,-1,-1,-1,-1,-1,-1);
    private $combinacionesGanadoras = array(
        array(0, 1, 2),
        array(3, 4, 5),
        array(6, 7, 8),
        array(0, 3, 6),
        array(1, 4, 7),
        array(2, 5, 8),
        array(0, 4, 8),
        array(2, 4, 6)
    );
	
	/**
	 * TicTacToe::__construct() Constructor de la clase TicTacToe.
	 * 
	 * @param string $nombre
	 * @return string
	 **/
	public function __construct($nombre = 'Mundo') {
		$this->nombre = $nombre;
	}
	
	/**
	 * TicTacToe::salude() Saluda al Mundo o a $this->nombre o saluda a $nombre si $nombre no es vacío.
	 * 
	 * @param string $nombre
	 * @return string
	 **/
	public function salude($nombre = '') {
		$nombre = $nombre?$nombre:$this->nombre;
		$this->ultimo_saludo = 'Hola '.$nombre.'.';
		return $this->ultimo_saludo;
	}

	public function juegoIniciado($nombre = '') {
        $this->tablero[intval($nombre)] = 1;
        $ganador = $this->checkWin(1);

        if($ganador){
            return '-1';
        }



        $jugadaCompu = $this->jugadaInteligente(0);

        if($jugadaCompu == -1){
            $jugadaCompu = $this->jugadaInteligente(1);
        }

        if($jugadaCompu == -1){
            $jugadaCompu = $this->randomFill();
        }

        if($jugadaCompu == -1){
            return '-2';
        }

        $this->tablero[$jugadaCompu] = 0;

        $ganaCompu = $this->checkWin(0);

        if($ganaCompu){
            return strval($jugadaCompu + 9);
        }

        return $jugadaCompu;
	}

    private function jugadaInteligente($jugador = 0){
        for($comb = 0; $comb < 8; $comb++){
            $ganadora = $this->combinacionesGanadoras[$comb];
            $contador = 0;

            if($this->tablero[$ganadora[0]] == $jugador){
                $contador += 1;
            }

            if($this->tablero[$ganadora[1]] == $jugador){
                $contador += 1;
            }

            if($this->tablero[$ganadora[2]] == $jugador){
                $contador += 1;
            }

            if($contador == 2){
                if($this->tablero[$ganadora[0]] == -1){
                    return $ganadora[0];
                }

                if($this->tablero[$ganadora[1]] == -1){
                    return $ganadora[1];
                }

                if($this->tablero[$ganadora[2]] == -1){
                    return $ganadora[2];
                }
            }
            
        }

        return -1;
    }

    private function randomFill(){
        $randomPos = -1;
        for($pos = 0; $pos < 9; $pos++){
            if($this->tablero[$pos] == -1){
                $randomPos = $pos;
                return $randomPos;
            }
        }
        return $randomPos;
    }

    private function checkWin($jugador = 0){
        $gana = false;
        for($comb = 0; $comb < 8; $comb++){
            $ganadora = $this->combinacionesGanadoras[$comb];
            if($this->tablero[$ganadora[0]] == $jugador && $this->tablero[$ganadora[1]] == $jugador && $this->tablero[$ganadora[2]] == $jugador){
                $gana = true;
                return $gana;
            }
        }
        return $gana;
    }

    private function sumar(){
        return $this->prueba += 1;
    }

	
	/**
	 * TicTacToe::servidorEstampillaDeTiempo() Devuelve el tiempo del servidor.
	 * 
	 * @return string 
	 **/
	public function servidorEstampillaDeTiempo() {
		return time();
	}
	
	/**
	 * TicTacToe::ultimoSaludo() Devuelve el saludo guardado en la propiedad ultimo_saludo.
	 * 
	 * @return string 
	 **/
	public function ultimoSaludo() {
		return 'Saludo guardado:  '.$this->ultimo_saludo;
	}
}

?>
