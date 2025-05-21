-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 21/05/2025 às 00:06
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `miauau`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `animais`
--

DROP TABLE IF EXISTS `animais`;
CREATE TABLE IF NOT EXISTS `animais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ong_id` int NOT NULL,
  `nome_animal` varchar(100) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `descricao` text,
  `idade` int DEFAULT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `sexo` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ong_id` (`ong_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `animais`
--

INSERT INTO `animais` (`id`, `ong_id`, `nome_animal`, `peso`, `descricao`, `idade`, `tipo`, `sexo`) VALUES
(1, 1, 'Pablo', 30.00, 'Pablo é um pastor alemão cheio de presença e coração. Com seu olhar atento e postura nobre, ele transmite confiança e lealdade. Apesar da aparência séria, é extremamente carinhoso com quem conquista sua confiança. Ama longas caminhadas, brincadeiras ao ar livre e ficar por perto da família. Pablo é o parceiro ideal para quem busca um amigo leal e protetor, pronto para viver aventuras e oferecer amor verdadeiro.', 5, 'cachorro', 'macho'),
(2, 2, 'Remy', 4.00, 'Remy é um gato silencioso, elegante e incrivelmente observador. Seus olhos curiosos estão sempre atentos aos mínimos detalhes da casa, e ele adora explorar cada cantinho com calma e graça. Tem um jeito próprio de se comunicar, com miados suaves e expressões que dizem muito. É o tipo de gato que escolhe seus momentos de carinho e, quando o faz, entrega todo seu afeto. Remy é perfeito para quem valoriza a companhia tranquila e cheia de personalidade felina.', 3, 'gato', 'macho'),
(3, 2, 'Nina', 1.50, 'Nina é uma coelhinha delicada e meiga que adora conforto e tranquilidade. Gosta de se aconchegar em cobertores, pular suavemente pela casa e explorar com seu jeitinho curioso. Transmite paz com sua presença e adora momentos de carinho em silêncio. Nina é ideal para quem procura uma companheira sensível e afetuosa, que enche o ambiente com doçura.', 2, 'coelho', 'femea'),
(4, 1, 'Jade', 1.10, 'Jade é uma arara-azul cheia de vida, beleza e personalidade. Suas penas vibrantes chamam atenção, mas é sua inteligência e doçura que realmente encantam. Comunicativa e curiosa, Jade adora brincar com objetos coloridos, explorar o ambiente e interagir com pessoas. Com seu jeitinho expressivo e afetuoso, ela é perfeita para quem tem carinho, paciência e deseja uma amiga alada cheia de charme e presença.\r\n\r\n', 6, 'passaro', 'femea');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fotos_animais`
--

DROP TABLE IF EXISTS `fotos_animais`;
CREATE TABLE IF NOT EXISTS `fotos_animais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `animal_id` int NOT NULL,
  `caminho_foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `animal_id` (`animal_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `fotos_animais`
--

INSERT INTO `fotos_animais` (`id`, `animal_id`, `caminho_foto`) VALUES
(1, 1, 'uploads/682d0ccc77f45_682b3bb537b78_pastor1.jpg'),
(2, 1, 'uploads/682d0ccc78850_682b3cc267b29_pastor3.jpg'),
(3, 2, 'uploads/682d0e34c4621_682b3f23586d0_gatosiames2.jpg'),
(4, 2, 'uploads/682d0e34c5039_682b3f235792c_gatosiames1.jpg'),
(5, 3, 'uploads/682d0f96af4e4_coelho1.jpg'),
(6, 3, 'uploads/682d0f96afcb9_coelho2.jpg'),
(7, 4, 'uploads/682d11c108440_passarin2.jpg'),
(8, 4, 'uploads/682d11c108b64_passarin6.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `ongs`
--

DROP TABLE IF EXISTS `ongs`;
CREATE TABLE IF NOT EXISTS `ongs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `numero_ong` varchar(20) NOT NULL,
  `nome_ong` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `ongs`
--

INSERT INTO `ongs` (`id`, `numero_ong`, `nome_ong`) VALUES
(1, '+558189720485', 'Cãopanhia do Amor'),
(2, '+558198723441', 'Ponto Pet');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
