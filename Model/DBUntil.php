
<?php
include "Database.php";
define("HOST", "localhost");
define("DB_NAME", "duan");
define("USERNAME", "root");
define("PASSWORD", "");

class DBUntil
{
    
    public $conn = null;
    function __construct()
    {
        try {
            $db = new Database(HOST, USERNAME, PASSWORD, DB_NAME);
            $this->conn = $db->getConnection();
        } catch (PDOException $e) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $e->getMessage());
        }
    }

    public function select($sql, $params = [])
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt->fetchAll();
    }

    public function insert($table, $data)
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }
        $keys = array_keys($data);
        $fields = implode(", ", $keys);
        $placeholders = ":" . implode(", :", $keys);
        $sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
        $stmt = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    public function update($table, $data, $condition, $conditionParams = [])
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }

        $updateFields = [];
        foreach ($data as $key => $value) {
            $updateFields[] = "$key = :$key";
        }
        $updateFields = implode(", ", $updateFields);
        $sql = "UPDATE $table SET $updateFields WHERE $condition";
        $stmt = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        // Bind condition parameters if any
        foreach ($conditionParams as $key => $value) {
            // Check if $key starts with a colon, if not, add it
            $paramKey = strpos($key, ':') === 0 ? $key : ":$key";
            $stmt->bindValue($paramKey, $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }




    public function delete($table, $condition, $conditionParams = [])
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->conn->prepare($sql);

        // Bind condition parameters if any
        foreach ($conditionParams as $key => $value) {
            // Check if $key starts with a colon, if not, add it
            $paramKey = strpos($key, ':') === 0 ? $key : ":$key";
            $stmt->bindValue($paramKey, $value);
        }

        $stmt->execute();
        return $stmt->rowCount();
    }
    public function checkRole($userId, $requiredRole)
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }

        $sql = "SELECT role FROM users WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":user_id", $userId);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        if ($user && isset($user['role']) && $user['role'] === $requiredRole) {
            return true;
        }
        return false;
    }

    /**
     * Xác định xem người dùng có phải admin không
     * @param int $userId
     * @return bool
     */
    public function isAdmin($userId)
    {
        return $this->checkRole($userId, 'admin');
    }

    /**
     * Xác định xem người dùng có phải user không
     * @param int $userId
     * @return bool
     */
    public function isUser($userId)
    {
        return $this->checkRole($userId, 'user');
    }

   
}



