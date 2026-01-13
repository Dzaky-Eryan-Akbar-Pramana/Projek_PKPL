<?php
/**
 * Database Connection Test
 * Jalankan script ini untuk menguji koneksi database
 */

echo "<h2>🔍 Database Connection Test</h2>";
echo "<hr>";

try {
    require_once 'includes/railway_database.php';
    $conn = RailwayDatabase::getConnection();
    
    echo "✅ <strong>Database connection: SUCCESS</strong><br>";
    echo "Host: " . $conn->get_server_info() . "<br>";
    echo "Client version: " . $conn->get_client_info() . "<br>";
    
    // Check if bookings table exists
    $result = $conn->query("SHOW TABLES LIKE 'bookings'");
    if ($result->num_rows > 0) {
        echo "✅ Table 'bookings': EXISTS<br>";
        
        // Check columns
        $columns = $conn->query("SHOW COLUMNS FROM bookings");
        echo "<br><strong>Columns in 'bookings' table:</strong><br>";
        while ($col = $columns->fetch_assoc()) {
            echo "  • " . $col['Field'] . " (" . $col['Type'] . ")<br>";
        }
    } else {
        echo "❌ Table 'bookings': NOT FOUND<br>";
        echo "<p><strong>Solusi:</strong> <a href='setup_database.php'>Jalankan setup_database.php</a></p>";
    }
    
    // Check services table
    echo "<br>";
    $result = $conn->query("SHOW TABLES LIKE 'services'");
    if ($result->num_rows > 0) {
        echo "✅ Table 'services': EXISTS<br>";
        $count = $conn->query("SELECT COUNT(*) as total FROM services")->fetch_assoc();
        echo "  Jumlah services: " . $count['total'] . "<br>";
    } else {
        echo "❌ Table 'services': NOT FOUND<br>";
    }
    
    // Check users table
    echo "<br>";
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "✅ Table 'users': EXISTS<br>";
        $count = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc();
        echo "  Jumlah users: " . $count['total'] . "<br>";
    } else {
        echo "❌ Table 'users': NOT FOUND<br>";
    }
    
    echo "<hr>";
    echo "<p><a href='index.php'>← Kembali ke Home</a></p>";
    
} catch (Exception $e) {
    echo "❌ <strong>Error: " . htmlspecialchars($e->getMessage()) . "</strong><br>";
    echo "<p>Pastikan:</p>";
    echo "<ul>";
    echo "<li>Database sudah berjalan</li>";
    echo "<li>Credentials di <code>includes/railway_database.php</code> benar</li>";
    echo "<li>Database <code>pierceflow_db</code> sudah dibuat</li>";
    echo "</ul>";
}
?>
