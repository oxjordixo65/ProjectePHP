<?php

    //LEYENDO DATOS
    $users=array();

    echo "<b>OBRINT EL FITXER EN MODE LECTURA I DESANT EL CONTINGUT DINS D'UN ARRAY DE STRINGS</b><br>";
    $filename="./Users/llistaUsuaris";
    $fitxer=fopen($filename,"r") or die ("No s'ha pogut obrir el fitxer");
    

    //mientras no sea el final del fichero leemos todas las lineas
    while(!feof($fitxer)) {
        $linea=fgets($fitxer);
        $pos = strpos($linea, "Username: "); //si la linea contiene username lo metemos en el array users
        if($pos !== false){
            array_push($users, $linea);
		}
        echo $linea. "<br />";

    }
    fclose($fitxer);

    //Mostrant tots els users
    var_dump($users);
    
    //METIENDO DATOS
    echo "<b>AFEGINT DADES AL FINAL DEL FITXER</b><br>";
    $filename="./Users/llistaUsuaris";
    $fitxer=fopen($filename,"a") or die ("No s'ha pogut obrir el fitxer 1");

    $username=$_POST["username"];
    $password=$_POST["passw"];

    $username2 =(string)("Username: ".$username.";");  //NO FUNCIONA
    
    echo "<br><br>Entrada user:".$username2."<br><br>";
    //Comprobamos si el usuario ya existe, si existe no lo metemos

    echo "Resultats array users: <br>";
    foreach($users as $u){
        echo $u."<br>";
    } 
    if(in_array("Username: polla;", $users)){ //NOSE PORQUE COÑO NO FUNCIONA
        echo "<br><br>JORDIII ESTE USUARIO YA EXISTE!<br><br>"; //NO FUNCIONA
        
    }
    
    if(in_array($username2, $users)){ //NOSE PORQUE COÑO NO FUNCIONA
        echo "<br><br>ESTE USUARIO YA EXISTE!<br><br>"; //NO FUNCIONA
        
    }else{
        
        $texte="Username: ".$username.";\n"."Password: ".$password.";\n";
        fwrite($fitxer,$texte);
    }

    fclose($fitxer);
    echo "<br>";
    

    if($username=="jordi" && $password=="1234"){
        echo "Hello admin";
    }else{
        echo "Hello ".$_POST["username"];
    }
    $people = array("Peter", "Joe", "Glenn", "Cleveland");

    if (in_array("Glenn", $people))
    {
    echo "Match found";
    }
    else
    {
    echo "Match not found";
    }

?>