<?php
// config.php - Database Configuration
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "quran_pj";
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->database};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]
            );
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    // Get all surahs
    public function getSurahs() {
        $stmt = $this->conn->prepare("SELECT DISTINCT suraId, COUNT(*) as ayat_count FROM quran_id GROUP BY suraId ORDER BY suraId");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Get ayahs by surah
    public function getAyahsBySurah($suraId) {
        $stmt = $this->conn->prepare("SELECT * FROM quran_id WHERE suraId = ? ORDER BY verseId");
        $stmt->execute([$suraId]);
        return $stmt->fetchAll();
    }

    // Search ayahs
    public function searchAyahs($query) {
        $stmt = $this->conn->prepare("SELECT * FROM quran_id WHERE ayahText LIKE ? OR indoText LIKE ? OR readText LIKE ? ORDER BY suraId, verseId LIMIT 50");
        $searchTerm = "%{$query}%";
        $stmt->execute([$searchTerm, $searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }

    // Get single ayah
    public function getAyah($suraId, $verseId) {
        $stmt = $this->conn->prepare("SELECT * FROM quran_id WHERE suraId = ? AND verseId = ?");
        $stmt->execute([$suraId, $verseId]);
        return $stmt->fetch();
    }
}
?>