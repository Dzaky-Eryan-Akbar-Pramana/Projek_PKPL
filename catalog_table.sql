-- Tabel catalog untuk galeri/portfolio piercing
CREATE TABLE IF NOT EXISTS catalog (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    description TEXT,
    category ENUM('telinga', 'hidung', 'industrial', 'helix', 'tragus', 'septum', 'lainnya') DEFAULT 'lainnya',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample catalog items
INSERT INTO catalog (title, image_url, description, category) VALUES
('Tindik Telinga Classic', 'Images/lobe.jpg', 'Tindik telinga klasik dengan anting stainless steel berkualitas tinggi.', 'telinga'),
('Tindik Hidung Modern', 'Images/hidung.jpg', 'Tindik hidung dengan stud titanium yang aman dan stylish.', 'hidung'),
('Industrial Piercing', 'Images/industrial.jpg', 'Tindik industrial dengan barbell panjang premium.', 'industrial'),
('Helix Piercing', 'Images/helix.webp', 'Tindik helix di cartilage telinga bagian atas.', 'helix'),
('Tragus Piercing', 'Images/tragus.jpg', 'Tindik tragus dengan perhiasan mini yang elegan.', 'tragus'),
('Lidah Piercing', 'Images/lidah.webp', 'Tindik lidah dengan jewelry surgical steel premium.', 'lainnya');
