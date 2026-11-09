CREATE DATABASE tienda_online;

CREATE TABLE clientes (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  telefono VARCHAR(20),
  contrasena VARCHAR(30) NOT NULL,
  usuario VARCHAR(30) NOT NULL 
);

CREATE TABLE categorias (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE productos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  nombre VARCHAR(150) NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL DEFAULT 0,
  categoria_id INT NOT NULL,
  FOREIGN KEY (categoria_id) REFERENCES categorias(id)
);

CREATE TABLE pedidos (
  id INT PRIMARY KEY AUTO_INCREMENT,
  cliente_id INT NOT NULL,
  fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (cliente_id) REFERENCES clientes(id)
);

CREATE TABLE detalle_pedido(
  pedido_id INT NOT NULL,
  producto_id INT NOT NULL,
  cantidad INT NOT NULL DEFAULT 1,
  precio_unitario DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (pedido_id, producto_id),
  FOREIGN KEY (pedido_id) REFERENCES pedidos(id) ON DELETE CASCADE,
  FOREIGN KEY (producto_id) REFERENCES productos(id)
);

INSERT INTO `categorias` (`nombre`) VALUES
('Ratones'),
('Teclados'),
('Memoria RAM'),
('Fuentes de alimentación'),
('Procesadores'),
('Placas base'),
('Tarjetas gráficas'),
('Discos duros HDD'),
('Discos SSD'),
('Monitores'),
('Cajas / Torres'),
('Refrigeración'),
('Auriculares'),
('Webcams'),
('Altavoces'),
('Alfombrillas'),
('Routers y redes'),
('Impresoras'),
('Cables y adaptadores'),
('Portátiles');



INSERT INTO `productos` (`modelo`, `precio`, `stock`, `categoria_id`, `marca`) VALUES
-- Ratones (1)
('G502 Hero', 49.99, 35, 1, 'Logitech'),
('DeathAdder V3', 69.90, 20, 1, 'Razer'),
('MX Master 3S', 99.99, 15, 1, 'Logitech'),

-- Teclados (2)
('K70 RGB Pro', 139.90, 12, 2, 'Corsair'),
('BlackWidow V4', 159.00, 8, 2, 'Razer'),
('Apex Pro', 199.99, 6, 2, 'SteelSeries'),

-- Memoria RAM (3)
('Vengeance DDR5 32GB 6000MHz', 129.90, 25, 3, 'Corsair'),
('Fury Beast DDR4 16GB 3200MHz', 44.95, 40, 3, 'Kingston'),
('Trident Z5 DDR5 32GB 6400MHz', 159.00, 10, 3, 'G.Skill'),

-- Fuentes de alimentación (4)
('RM850x 850W 80+ Gold', 149.90, 14, 4, 'Corsair'),
('Focus GX-750 750W', 109.00, 18, 4, 'Seasonic'),

-- Procesadores (5)
('Ryzen 7 7800X3D', 389.00, 9, 5, 'AMD'),
('Core i5-14600K', 319.90, 11, 5, 'Intel'),
('Ryzen 5 7600', 199.00, 22, 5, 'AMD'),

-- Placas base (6)
('ROG Strix B650-A Gaming WiFi', 259.00, 7, 6, 'ASUS'),
('MAG B760 Tomahawk WiFi', 199.90, 10, 6, 'MSI'),

-- Tarjetas gráficas (7)
('GeForce RTX 4070 Super', 639.00, 5, 7, 'NVIDIA'),
('Radeon RX 7800 XT', 529.90, 6, 7, 'AMD'),

-- Discos duros HDD (8)
('Barracuda 2TB', 59.99, 30, 8, 'Seagate'),
('WD Blue 4TB', 94.90, 16, 8, 'Western Digital'),

-- Discos SSD (9)
('980 Pro NVMe 1TB', 99.00, 28, 9, 'Samsung'),
('SN850X NVMe 2TB', 169.90, 13, 9, 'Western Digital'),

-- Monitores (10)
('Odyssey G5 27" 1440p 144Hz', 279.00, 9, 10, 'Samsung'),
('UltraGear 27GP850 27" 165Hz', 319.90, 7, 10, 'LG'),

-- Cajas / Torres (11)
('4000D Airflow', 99.90, 15, 11, 'Corsair'),
('H5 Flow', 94.99, 12, 11, 'NZXT'),

-- Refrigeración (12)
('Hyper 212 Black', 39.90, 33, 12, 'Cooler Master'),
('Kraken 240 AIO', 149.99, 8, 12, 'NZXT'),

-- Auriculares (13)
('Cloud II Wireless', 129.99, 17, 13, 'HyperX'),
('BlackShark V2 Pro', 179.00, 9, 13, 'Razer'),

-- Webcams (14)
('C920 HD Pro', 69.90, 21, 14, 'Logitech'),

-- Altavoces (15)
('Z313 2.1', 44.99, 19, 15, 'Logitech'),

-- Alfombrillas (16)
('MM300 Pro Extended', 24.90, 45, 16, 'Corsair'),

-- Routers y redes (17)
('Archer AX55 WiFi 6', 79.90, 20, 17, 'TP-Link'),

-- Impresoras (18)
('EcoTank ET-2850', 229.00, 6, 18, 'Epson'),

-- Cables y adaptadores (19)
('Cable HDMI 2.1 2m', 12.95, 80, 19, 'Ugreen'),

-- Portátiles (20)
('Vivobook 15 Ryzen 7 16GB 512GB', 699.00, 5, 20, 'ASUS');

