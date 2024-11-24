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

    // Phương thức select: Lấy dữ liệu từ cơ sở dữ liệu
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

    // Phương thức insert: Thêm bản ghi mới vào cơ sở dữ liệu
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

    // Phương thức update: Cập nhật bản ghi trong cơ sở dữ liệu
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

        // Bind điều kiện nếu có
        foreach ($conditionParams as $key => $value) {
            $paramKey = strpos($key, ':') === 0 ? $key : ":$key";
            $stmt->bindValue($paramKey, $value);
        }

        $stmt->execute();
        return $stmt->rowCount(); // Trả về số dòng bị ảnh hưởng
    }

    // Phương thức delete: Xóa bản ghi khỏi cơ sở dữ liệu
    public function delete($table, $condition, $conditionParams = [])
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }

        // Chuẩn bị câu lệnh SQL với điều kiện
        $sql = "DELETE FROM $table WHERE $condition";
        $stmt = $this->conn->prepare($sql);

        // Bind các tham số nếu có
        if (!empty($conditionParams)) {
            foreach ($conditionParams as $key => $value) {
                // Đảm bảo bind value với key có dấu ":"
                $paramKey = strpos($key, ':') === 0 ? $key : ":$key";
                $stmt->bindValue($paramKey, $value);
            }
        }

        // Thực thi câu lệnh SQL
        $stmt->execute();

        // Trả về số dòng bị ảnh hưởng (số bản ghi bị xóa)
        return $stmt->rowCount();
    }


    // Phương thức checkRole: Kiểm tra vai trò của người dùng
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

    // Phương thức kiểm tra admin
    public function isAdmin($userId)
    {
        return $this->checkRole($userId, 'admin');
    }

    // Phương thức kiểm tra user
    public function isUser($userId)
    {
        return $this->checkRole($userId, 'user');
    }

    // Phương thức execute: Thực thi câu lệnh SQL
    public function execute($sql, $params = [])
    {
        if ($this->conn == null) {
            die("Không thể kết nối cơ sở dữ liệu");
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->rowCount(); // Trả về số dòng bị ảnh hưởng
    }

    // Phương thức getConnection: Lấy kết nối cơ sở dữ liệu
    public function getConnection()
    {
        return $this->conn;
    }

    public function getLastInsertId() {
        return $this->conn->lastInsertId(); // Trả về ID của bản ghi vừa được thêm vào
    }
}
