<?php
/**
 * Database Setup Script
 * Jalankan script ini untuk membuat dan setup semua table yang diperlukan
 */

require_once 'includes/railway_database.php';

try {
    $conn = RailwayDatabase::getConnection();
    echo "<h2>🔧 Database Setup</h2>";
    
    // Create users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        phone VARCHAR(20) NOT NULL,
        password VARCHAR(255) NOT NULL,
        role ENUM('user','admin') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    echo "✅ Table users: OK<br>";
    
    // Create services table
    $sql = "CREATE TABLE IF NOT EXISTS services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    echo "✅ Table services: OK<br>";
    
    // Create bookings table - DENGAN service_type
    $sql = "CREATE TABLE IF NOT EXISTS bookings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        service_id INT NOT NULL,
        service_type ENUM('studio', 'home_service') NOT NULL,
        date DATE NOT NULL,
        time TIME NOT NULL,
        address TEXT,
        status ENUM('pending', 'confirmed', 'cancelled', 'rejected') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE
    )";
    $conn->query($sql);
    echo "✅ Table bookings: OK<br>";
    
    // Create consultations table
    $sql = "CREATE TABLE IF NOT EXISTS consultations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        message TEXT NOT NULL,
        admin_response TEXT,
        status ENUM('pending', 'responded', 'closed') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";
    $conn->query($sql);
    echo "✅ Table consultations: OK<br>";
    
    // Create catalog table
    $sql = "CREATE TABLE IF NOT EXISTS catalog (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100) NOT NULL,
        description TEXT,
        image VARCHAR(255),
        category VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $conn->query($sql);
    echo "✅ Table catalog: OK<br>";
    
    // Create notifications table
    $sql = "CREATE TABLE IF NOT EXISTS notifications (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        booking_id INT,
        type VARCHAR(50),
        title VARCHAR(255),
        message TEXT,
        is_read TINYINT(1) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
    )";
    $conn->query($sql);
    echo "✅ Table notifications: OK<br>";
    
    echo "<hr>";
    echo "<h3>✨ Database setup berhasil!</h3>";
    echo "<p>Sekarang Anda bisa menggunakan aplikasi PierceFlow.</p>";
    echo "<p><a href='index.php'>← Kembali ke Home</a></p>";
    
} catch (Exception $e) {
    echo "<h2>❌ Error Setup Database</h2>";
    echo "<p style='color: red;'>" . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p>Pastikan database connection sudah benar di <code>includes/railway_database.php</code></p>";
}
?>
