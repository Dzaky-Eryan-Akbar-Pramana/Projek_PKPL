<?php
/**
 * Create Admin User Script
 */

require_once 'includes/railway_database.php';

try {
    $conn = RailwayDatabase::getConnection();
    
    echo "<h2>🔧 Creating Admin User...</h2>";
    echo "<hr>";
    
    // Clear existing admin with same email
    $deleteStmt = $conn->prepare("DELETE FROM users WHERE email = ?");
    $deleteEmail = 'admin@pierceflow.local';
    $deleteStmt->bind_param("s", $deleteEmail);
    $deleteStmt->execute();
    echo "✅ Cleared existing admin user<br>";
    
    // Create new admin with correct password
    $adminEmail = 'admin@pierceflow.local';
    $adminPassword = password_hash('adminkeren', PASSWORD_BCRYPT);
    $adminName = 'Administrator';
    $adminPhone = '081234567890';
    $adminRole = 'admin';
    
    $insertStmt = $conn->prepare("INSERT INTO users (name, email, phone, password, role) VALUES (?, ?, ?, ?, ?)");
    $insertStmt->bind_param("sssss", $adminName, $adminEmail, $adminPhone, $adminPassword, $adminRole);
    
    if ($insertStmt->execute()) {
        echo "✅ Admin user created successfully!<br><br>";
        echo "<strong>📋 Login Credentials:</strong><br>";
        echo "Email: <code>admin@pierceflow.local</code><br>";
        echo "Password: <code>adminkeren</code><br><br>";
        echo "<a href='login.php' style='background: #8b5cf6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>→ Go to Login</a>";
    } else {
        echo "❌ Error creating admin: " . $insertStmt->error . "<br>";
    }
    
    $deleteStmt->close();
    $insertStmt->close();
    
} catch (Exception $e) {
    echo "❌ Error: " . htmlspecialchars($e->getMessage()) . "<br>";
}
?>
