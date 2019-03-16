<?
class DBManager {
    ///==================================================
    /// Parametros de conexión con base de datos
    ///==================================================
    
    private $user = "root"; // Usuario de bd
    private $password = "Hh@-240897"; // Password bd
    private $db = "LoginManager"; // Nombre db
    private $host = "localhost"; // Host db

    ///==============================================
    /// Variables de control interacción con BD
    ///==============================================

    private $queryTotal = 0; // Numero de queries ejecutadas en esta session


    private $conn; //Conexion con db

    public function DBManager() {
        if (!isset($this->$conn)) {
            $this->$conn = mysqli_connect($this->$host, $this->$user, $this->$password, $this->$db);
            if (DBAuth::$conn->connect_error) {
                die('Conexión con base de datos falló: ' . $this->$conn->connect_error);
            }

        }
    }




}



?>