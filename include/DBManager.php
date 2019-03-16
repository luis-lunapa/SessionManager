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

    private $quey = "";
    private $comment = "";


    private $conn; //Conexion con db

    public function DBManager() {
        if (!isset($this->conn)) {
            $this->conn = mysqli_connect($this->host, $this->user, $this->password, $this->db);
            if ($this->conn->connect_error) {
                die('Conexión con base de datos falló: ' . $this->conn->connect_error);
            }

        }
    }

    /*

    Esta funcion obtiene de un registro varios campos

    */

    public function querySelect($comment = "", $query = "") {

        if ($comment == "") {

            echo "Query sin comentario.";
            return;
        }

        if ($query == "") {
            echo "Query vacia";
            return;
        }

        

        $this->query = $query;
        $this->comment = $comment;

        $result = $this->conn->query($query);

        return $result;

    }

    /*

    Esta funcion obtiene de un registro un solo valor

    */

    public function queryValue($comment = "", $query = "") {

        if ($comment == "") {

            echo "Query sin comentario.";
            return;
        }

        if ($query == "") {
            echo "Query vacia";
            return;
        }

        

        $this->query = $query;
        $this->comment = $comment;

        $this->conn->query($quey);


    }

    /*

    Esta funcion obtiene varis registros con varios campos

    */

    public function queryMatrix($comment = "", $query = "") {

        if ($comment == "") {

            echo "Query sin comentario.";
            return;
        }

        if ($query == "") {
            echo "Query vacia";
            return;
        }

        

        $this->query = $query;
        $this->comment = $comment;

        $this->conn->query($quey);


    }

    public function printQuery() {
        echo($this->query);
    }





}



?>