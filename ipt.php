<? $path = getcwd();
   echo "O seu caminho absoluto é: ";
   echo $path;

echo "IP ADDR :- ".$_SERVER['REMOTE_ADDR'];

echo "<br />";

echo "IP HOST :- ".$_SERVER['REMOTE_HOST'];

echo "<br />";

echo "IP NAME :- ".$_SERVER['REMOTE_NAME'];

echo "<br />";

echo "IP PORT :- ".$_SERVER['REMOTE_PORT'];

echo "<br />";

echo "Navegador :- ".$_SERVER["HTTP_USER_AGENT"];

echo "<br />";

echo "URL :- ".$_SERVER["REQUEST_URI"];

echo "<br />";

echo "URL :- ".$_SERVER['PHP_SELF'];

echo "<br />";

echo "Caminha absoluto :- ".$_SERVER["SCRIPT_FILENAME"];

echo "<br />";

echo "Servidor ".$_SERVER['SERVER_NAME'];

echo "<br />";

echo "Porta do servidor ".$_SERVER['SERVER_PORT'];
?>