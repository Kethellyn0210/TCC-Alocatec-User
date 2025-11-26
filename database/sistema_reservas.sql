CREATE DATABASE sistema_reservas;
USE sistema_reservas;

CREATE TABLE usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    rg VARCHAR(20) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE administrador (
    id_administrador INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE estabelecimento (
    id_estabelecimento INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    numero NUMERIC(5) NOT NULL,
    bairro VARCHAR(150) NOT NULL,
    cep VARCHAR(10) NOT NULL,
    cidade VARCHAR(150) NOT NULL,
    complemento VARCHAR(150),
    uf VARCHAR(2) NOT NULL,
    status ENUM('Ativo', 'Inativo') NOT NULL,
    inicio TIME NOT NULL,
    termino TIME NOT NULL,
    disponibilidade ENUM('Seg-Sex', 'Sab-Dom', 'Seg-Dom') NOT NULL,
    id_administrador INT NOT NULL,
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);


CREATE TABLE espaco (
    id_espaco INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(50) NOT NULL,
    capacidade INT NOT NULL,
    cobertura ENUM('Sim', 'Não') NOT NULL,
    largura VARCHAR(10),
    comprimento VARCHAR(10),
    localidade VARCHAR(100) NOT NULL,
    status ENUM('disponível', 'indisponível') NOT NULL,
    id_estabelecimento INT NOT NULL,
    FOREIGN KEY (id_estabelecimento) REFERENCES estabelecimento(id_estabelecimento)
);

CREATE TABLE reserva (
    id_reserva INT AUTO_INCREMENT PRIMARY KEY,
    data DATE NOT NULL,
    horario TIME NOT NULL,
    status ENUM('pendente', 'concluída', 'cancelada') NOT NULL,
    id_usuario INT NOT NULL,
    id_espaco INT NOT NULL,
    id_administrador INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario),
    FOREIGN KEY (id_espaco) REFERENCES espaco(id_espaco),
    FOREIGN KEY (id_administrador) REFERENCES administrador(id_administrador)
);

INSERT INTO administrador (nome, email, telefone, endereco, senha) VALUES
('Ana Souza', 'ana@admin.com', '11987654321', 'Rua das Flores, 100', MD5('12345')),
('Carlos Pereira', 'carlos@admin.com', '11999887766', 'Av. Central, 200', MD5('12345')),
('Marcos Lima', 'marcos@admin.com', '11911223344', 'Rua Azul, 50', MD5('12345')),
('Patrícia Gomes', 'patricia@admin.com', '11922334455', 'Av. Verde, 75', MD5('12345')),
('Renato Alves', 'renato@admin.com', '11933445566', 'Rua Vermelha, 33', MD5('12345')),
('Juliana Costa', 'juliana@admin.com', '11944556677', 'Av. Laranja, 88', MD5('12345')),
('Eduardo Santos', 'eduardo@admin.com', '11955667788', 'Rua Amarela, 101', MD5('12345')),
('Fernanda Melo', 'fernanda@admin.com', '11966778899', 'Av. Roxa, 120', MD5('12345')),
('Lucas Ribeiro', 'lucas@admin.com', '11977889900', 'Rua Rosa, 200', MD5('12345')),
('Carla Martins', 'carla@admin.com', '11988990011', 'Av. Prata, 250', MD5('12345'));

INSERT INTO estabelecimento (nome, endereco, status, inicio, termino, disponibilidade, id_administrador) VALUES
('Centro Esportivo Zona Sul', 'Rua Verde, 123', 'Ativo', '07:00:00', '22:00:00', 'Seg-Dom', 1),
('Arena Norte', 'Av. Paulista, 456', 'Ativo', '08:00:00', '21:00:00', 'Seg-Sex', 2),
('Clube Leste', 'Rua Leste, 78', 'Ativo', '06:30:00', '23:00:00', 'Seg-Dom', 3),
('Ginásio Central', 'Av. Central, 90', 'Inativo', '08:00:00', '18:00:00', 'Seg-Sex', 4),
('Espaço Multiuso', 'Rua Nova, 12', 'Ativo', '09:00:00', '20:00:00', 'Sab-Dom', 5),
('Academia Oeste', 'Av. Oeste, 33', 'Ativo', '05:00:00', '23:00:00', 'Seg-Dom', 6),
('Pavilhão Sul', 'Rua do Sol, 44', 'Inativo', '08:00:00', '19:00:00', 'Seg-Sex', 7),
('Estádio Norte', 'Av. das Estrelas, 55', 'Ativo', '07:00:00', '22:00:00', 'Seg-Dom', 8),
('Complexo Central', 'Rua Principal, 66', 'Ativo', '06:00:00', '22:00:00', 'Seg-Dom', 9),
('Auditório Principal', 'Av. da Liberdade, 77', 'Ativo', '08:00:00', '20:00:00', 'Seg-Sex', 10);


INSERT INTO usuario (nome, email, telefone, rg, endereco, senha) VALUES
('João Silva', 'joao@email.com', '11911112222', '1234567', 'Rua A, 10', MD5('12345')),
('Maria Oliveira', 'maria@email.com', '11933334444', '7654321', 'Rua B, 20', MD5('12345')),
('Pedro Santos', 'pedro@email.com', '11955556666', '9876543', 'Rua C, 30', MD5('12345')),
('Juliana Costa', 'juliana@email.com', '11977778888', '1928374', 'Rua D, 40', MD5('12345')),
('Lucas Almeida', 'lucas@email.com', '11988889999', '5647382', 'Rua E, 50', MD5('12345')),
('Fernanda Lima', 'fernanda@email.com', '11999990000', '8372619', 'Rua F, 60', MD5('12345')),
('Eduardo Rocha', 'eduardo@email.com', '11912121212', '1928374', 'Rua G, 70', MD5('12345')),
('Carla Martins', 'carla@email.com', '11934343434', '9182736', 'Rua H, 80', MD5('12345')),
('Rafael Souza', 'rafael@email.com', '11956565656', '5647382', 'Rua I, 90', MD5('12345')),
('Patrícia Gomes', 'patricia@email.com', '11978787878', '8372619', 'Rua J, 100', MD5('12345'));

INSERT INTO espaco (tipo, capacidade, localidade, status, id_estabelecimento) VALUES
('Quadra de Futebol', 20, 'Pátio Principal', 'disponível', 1),
('Quadra de Vôlei', 12, 'Bloco B', 'disponível', 1),
('Sala de Reunião', 8, 'Bloco A - 2º andar', 'indisponível', 2),
('Auditório', 100, 'Bloco C', 'disponível', 2),
('Piscina', 30, 'Área Externa', 'disponível', 3),
('Campo de Tênis', 10, 'Bloco D', 'indisponível', 4),
('Sala de Treinamento', 15, 'Bloco E', 'disponível', 5),
('Ginásio Coberto', 50, 'Bloco F', 'disponível', 6),
('Quadra Poliesportiva', 25, 'Pátio Lateral', 'disponível', 7),
('Auditório Principal', 120, 'Bloco G', 'indisponível', 8);

INSERT INTO reserva (data, horario, status, id_usuario, id_espaco, id_administrador) VALUES
('2025-10-20', '10:00:00', 'pendente', 1, 1, 1),
('2025-10-21', '14:00:00', 'concluída', 2, 2, 1),
('2025-10-22', '09:30:00', 'pendente', 3, 3, 2),
('2025-10-23', '16:00:00', 'cancelada', 4, 4, 2),
('2025-10-24', '11:00:00', 'pendente', 5, 5, 3),
('2025-10-25', '15:30:00', 'concluída', 6, 6, 4),
('2025-10-26', '08:00:00', 'pendente', 7, 7, 5),
('2025-10-27', '13:00:00', 'cancelada', 8, 8, 6),
('2025-10-28', '10:30:00', 'concluída', 9, 9, 7),
('2025-10-29', '17:00:00', 'pendente', 10, 10, 8);

INSERT INTO estabelecimento (
    nome, endereco, numero, bairro, cep, cidade, complemento, uf, status, inicio, termino, disponibilidade, id_administrador
) VALUES
('Clube Alocatec', 'Av. Brasil', 1200, 'Centro', '12345-678', 'São Paulo', 'Próximo ao metrô', 'SP', 'Ativo', '08:00:00', '22:00:00', 'Seg-Sex', 1),
('Arena Esportiva Sol Nascente', 'Rua das Palmeiras', 45, 'Jardim Tropical', '98765-432', 'Rio de Janeiro', NULL, 'RJ', 'Ativo', '07:00:00', '23:00:00', 'Seg-Dom', 1),
('Espaço Verde', 'Av. Beira Mar', 500, 'Praia Grande', '11223-445', 'Fortaleza', 'Em frente ao quiosque 12', 'CE', 'Inativo', '09:00:00', '20:00:00', 'Sab-Dom', 1);

INSERT INTO espaco (
    tipo, capacidade, cobertura, largura, comprimento, localidade, status, id_estabelecimento
) VALUES
('Quadra Poliesportiva', 50, 'Sim', '30', '50', 'Bloco A', 'disponível', 1),
('Salão de Festas', 100, 'Sim', '20', '40', 'Prédio Central', 'disponível', 1),
('Campo de Futebol', 200, 'Não', '90', '120', 'Área Externa', 'indisponível', 2),
('Piscina Olímpica', 80, 'Não', '25', '50', 'Complexo Aquático', 'disponível', 2),
('Auditório', 60, 'Sim', '15', '30', 'Bloco B', 'disponível', 3);

  SELECT tipo, capacidade, cobertura, largura, comprimento, 
    localidade, E.id_estabelecimento
    FROM espaco E
    INNER JOIN estabelecimento T ON E.id_estabelecimento = T.id_estabelecimento
    WHERE T.id_estabelecimento = 1;

SELECT 
    R.id_reserva,
    R.data,
    R.horario,
    R.status,
    U.nome AS usuario,
    E.tipo AS espaco,
    A.nome AS administrador
FROM reserva R
INNER JOIN usuario U ON R.id_usuario = U.id_usuario
INNER JOIN espaco E ON R.id_espaco = E.id_espaco
INNER JOIN administrador A ON R.id_administrador = A.id_administrador;

select * from estabelecimento;

  SELECT nome, endereco, numero, bairro, cep, cidade, 
           complemento, uf, inicio, termino, disponibilidade, status
    FROM estabelecimento
    WHERE id_estabelecimento = $id_estabelecimento;
    
	SELECT tipo, capacidade, cobertura, largura, comprimento, 
    localidade, E.id_estabelecimento
    FROM espaco E
    INNER JOIN estabelecimento T ON E.id_estabelecimento = T.id_estabelecimento
    WHERE T.id_estabelecimento = 1;

select id_administrador from administrador;
DESCRIBE espaco;