-- Tabla de Usuarios (Admin, Técnico, Usuario)
CREATE TABLE usuarios (
    id_usuario SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    rol VARCHAR(20) CHECK (rol IN ('Usuario', 'Técnico', 'Administrador')) NOT NULL
);

-- Tabla de Equipos
CREATE TABLE equipos (
    id_equipo SERIAL PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    descripcion TEXT,
    ubicacion VARCHAR(100),
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de Reportes de Fallas
CREATE TABLE reportes (
    id_reporte SERIAL PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_equipo INT NOT NULL,
    titulo VARCHAR(150) NOT NULL,
    descripcion TEXT NOT NULL,
    estado VARCHAR(20) CHECK (estado IN ('Abierto', 'En Proceso', 'Resuelto', 'Cerrado')) DEFAULT 'Abierto',
    fecha_reporte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE,
    FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
);

-- Tabla de Seguimiento de Reportes (Historial de Acciones)
CREATE TABLE historial_acciones (
    id_historial SERIAL PRIMARY KEY,
    id_reporte INT NOT NULL,
    id_usuario INT NOT NULL,  -- Técnico o administrador
    accion TEXT NOT NULL,
    fecha_accion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_reporte) REFERENCES reportes(id_reporte) ON DELETE CASCADE,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario) ON DELETE CASCADE
);
