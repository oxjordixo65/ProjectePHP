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
    public function registrar()
    {

        //LEYENDO DATOS



        echo "<b>OBRINT EL FITXER EN MODE LECTURA I DESANT EL CONTINGUT DINS D'UN ARRAY DE STRINGS</b><br>";
        
        $fitxer = fopen(self::$filename, "r") or die("No s'ha pogut obrir el fitxer");


        //mientras no sea el final del fichero leemos todas las lineas
        echo "<h1>Users & passwords</h1>";

        //Metiendo los users del fichero a un array
        $contador = 0;
        while (!feof($fitxer)) {

            $linea = fgets($fitxer);
            if ($contador % 2 === 0) {
                $pos = strpos($linea, $this->username); //si la linea contiene username lo metemos en el array users

                array_push(self::$users, $linea);
            }

            $contador++;


            echo $linea . "<br />";
        }
        fclose($fitxer);

        //Mostrant tots els users
        //var_dump($users);

        //METIENDO DATOS
        echo "<b>AFEGINT DADES AL FINAL DEL FITXER</b><br>";
        
        $fitxer = fopen(self::$filename, "a") or die("No s'ha pogut obrir el fitxer 1");


        var_dump(self::$users);
        $comprobarExistenciaUser = $this->username . "\n";  //Hay que meter el \n para que funcione porque es un char oculto


        //ALZHEIMER!!! AQUI HACEMOS LA COMPROVACION DE LA EXISTENCIA DE LOS USUARIOS GRACIAS AL ARRAY QUE TANTO
        //NOS HA COSTADO :D
        if (in_array($comprobarExistenciaUser, self::$users)) {
            echo "<br><br>El usuario: " . $this->username . " ya existe<br><br>";
        } else {
            echo "<br><br>El usuario: " . $this->username . " se ha creado con éxito<br><br>";
            $texte =  $this->username . "\n" . $this->password . "\n";
            fwrite($fitxer, $texte);
        }

        $stat = fstat($fitxer);
        ftruncate($fitxer, $stat['size']-1);
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

        
    
        for ($i = 0; $i < count(self::$usersLogin); $i += 2) { //si pones $i+2 no se guarda el valor en i, $i++ si que guarda el valor en i
            
            self::$arrayAsociativoUsers[trim(self::$usersLogin[$i], "\n")] = self::$usersLogin[$i + 1]; //trim!! IMPORTANTE PORQUE NUESTRA CADENA DE USER TIENE UN CARACTER ESPECIAL
                                                                                                        // \n
        }

        

        
        if(array_key_exists($us,self::$arrayAsociativoUsers)){
            if(self::$arrayAsociativoUsers[$us]===$ps){
                session_start();
               
                echo "Sesion iniciada con ".$us;
            }
        }
        
        fclose($fitxer);
    }
}
?>
