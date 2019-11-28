<?php


class Usuari
{
    private $username;
    private $password;
    public static $users = array();
    public static $usersLogin = array();
    public static $arrayAsociativoUsers = array();
    public static $filename = "./Users/llistaUsuaris";

    public function __construct($usr, $pass)
    {
        $this->username = $usr;
        $this->password = $pass;
    }

    public function __get($prop)
    {
        if (property_exists($this, $prop)) {
            return $this->prop;
        } else {
            return -1;
        }
    }



    public function __set($prop, $valor)
    {
        if (property_exists($this, $prop)) {
            $this->prop = $valor;
        }
    }

    # TO STRING
    public function __toString()
    {
        return "Usuari amb username: " . $this->username . "y password:" . $this->password . "\n";
    }

    static function mostrarUsers(){
        //LEYENDO DATOS

        $fitxer = fopen(self::$filename, "r") or die("No s'ha pogut obrir el fitxer");

        //Metiendo los users del fichero a un array
        $contador = 0;
        while (!feof($fitxer)) {

            $linea = fgets($fitxer);
            if ($contador % 2 === 0) {
                
                array_push(self::$users, $linea);
                echo "<h5 style='margin-left: 1em; margin-top: 1em;'>$linea</h5>";
            }
            $contador++;


        }
        fclose($fitxer);
        //var_dump(self::$users);
        
    }

    //registrar user
    public function registrar()
    {

        //LEYENDO DATOS

        $fitxer = fopen(self::$filename, "r") or die("No s'ha pogut obrir el fitxer");

        //Metiendo los users del fichero a un array
        $contador = 0;
        while (!feof($fitxer)) {

            $linea = fgets($fitxer);
            if ($contador % 2 === 0) {
                $pos = strpos($linea, $this->username); //si la linea contiene username lo metemos en el array users
                array_push(self::$users, $linea);
            }
            $contador++;

        }
        fclose($fitxer);

        
        //METIENDO DATOS
        
        $fitxer = fopen(self::$filename, "a") or die("No s'ha pogut obrir el fitxer 1");

        $comprobarExistenciaUser = $this->username . "\n";  //Hay que meter el \n para que funcione porque es un char oculto


        //AQUI HACEMOS LA COMPROVACIÓN DE LA EXISTENCIA DE LOS USUARIOS GRACIAS AL ARRAY QUE TANTO
        //NOS HA COSTADO :D
        if (in_array($comprobarExistenciaUser, self::$users)) {

            return 1;//Si el usuario ya existe en el array devolvemos 1

        } else { //Si no existe en el array lo introducimos en el fichero de usuarios y devolvemos 0

            $texte =  $this->username . "\n" . $this->password . "\n";
            fwrite($fitxer, $texte);
            return 0;
            
        }

        
        fclose($fitxer);
        echo "<br>";
    }


    //COMPROBAR LOGIN!!

    static function comprobarLogin($us,$ps)
    {
        //LEYENDO DATOS

        $fitxer = fopen(self::$filename, "r") or die("No s'ha pogut obrir el fitxer");

        while (!feof($fitxer)) {

            $linea = fgets($fitxer);
            array_push(self::$usersLogin, $linea);

        }

        for ($i = 0; $i < count(self::$usersLogin)-1; $i += 2) { //si pones $i+2 no se guarda el valor en i, $i++ si que guarda el valor en i
            
            self::$arrayAsociativoUsers[trim(self::$usersLogin[$i], "\n")] = self::$usersLogin[$i + 1]; //trim!! IMPORTANTE PORQUE NUESTRA CADENA DE USER TIENE UN CARACTER ESPECIAL \n
                                                                                                        
        }

        if(array_key_exists($us,self::$arrayAsociativoUsers)){// si la key user se encuentra en el array asociativo de usuarios entra
            if(self::$arrayAsociativoUsers[$us]==$ps."\n"){//ATENCION "\n" -- Si en la posicion $us del arrayasocitivodeusers es igual al $ps es decir password de entrada

                session_start(); //iniciamos la session
                
                return 0;

            }else{//CONTRASEÑA MAL
                
                return 1;
            }
        }else{//USER NO EXISTE
            return 2;
        }
        
        fclose($fitxer); //Cerramos el fichero al finalizar el login


    }

    
}
?>
