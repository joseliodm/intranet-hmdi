-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 13-Dez-2022 às 17:54
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `aniversario`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aniversariantes`
--

CREATE TABLE `aniversariantes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `funcao` varchar(220) DEFAULT NULL,
  `dia` varchar(220) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aniversariantes`
--

INSERT INTO `aniversariantes` (`id`, `nome`, `funcao`, `dia`) VALUES
(2556, 'LECIO MACHADO DUARTE', 'ANALISTA DE NIVEL TECNICO', '2'),
(2557, 'MARIA RAIMUNDA DA SILVA', 'TECNICO EM ENFERMAGEM', '2'),
(2558, 'BARBARA MARIA BIAGE TEIXEIRA', 'MEDICO NEONATOLOGISTA', '4'),
(2559, 'LUZINETE REZENDE DA INCARNACAO', 'ASSISTENTE SOCIAL', '4'),
(2560, 'ANA CLAUDIA FERREIRA DE GODOI RIBEIRO', 'TECNICO EM ENFERMAGEM', '5'),
(2561, 'EVANIA VIANA DA SILVA GOMES', 'TECNICO EM ENFERMAGEM', '5'),
(2562, 'SIMONE CARRIJO SANTOS', 'MEDICO INTENSIVISTA EM NEONATOLOGIA', '5'),
(2563, 'DUILIO TADEU ALVES DE SOUZA', 'COMPRADOR', '6'),
(2564, 'ELIENE RODRIGUES DOS SANTOS', 'TECNICO EM ENFERMAGEM', '6'),
(2565, 'GISLANNY MIKAELLY DA SILVA SANTOS', 'ENFERMEIRO ASSISTENCIAL', '6'),
(2566, 'LUCAS OLIVEIRA FERNANDES', 'TECNICO DE LABORATORIO DE ANALISES CLINICAS', '6'),
(2567, 'MICHELLE MARTINS DA SILVA ALVES', 'AUXILIAR DE ROUPARIA E LAVANDERIA', '6'),
(2568, 'CLÁUDIA SOARES TELES', 'TÉCNICO DE LABORATÓRIO', '7'),
(2569, 'CORACY COSTA BARROS DUARTE', 'TECNICO EM ENFERMAGEM', '7'),
(2570, 'CRISTIANE MARTINS BARBOSA', 'TECNICO EM FARMACIA', '7'),
(2571, 'HELIANA MARIA DE OLIVEIRA', 'ENFERMEIRO ASSISTENCIAL', '8'),
(2572, 'MARINA DUTRA OLIVEIRA', 'MEDICO NEONATOLOGISTA', '8'),
(2573, 'PRISCILA DIAS WATANABE', 'MEDICO GINECOLOGISTA/OBSTETRA', '8'),
(2574, 'VALERIA GOMES D ABADIA SANTOS', 'TECNICO EM ENFERMAGEM', '8'),
(2575, 'DILZA GOMES RIBEIRO', 'TÉCNICO DE RADIOLOGIA', '9'),
(2576, 'JOSIANE MEDEIRO DO NASCIMENTO', 'ASSISTENTE ADMINISTRATIVO II', '9'),
(2577, 'SUZANA CRISTINA DE ALMEIDA', 'TECNICO DE LABORATORIO DE ANALISES CLINICAS', '9'),
(2578, 'CRISTIANE PORTO CORTEZ BITTAR', 'MÉDICO GINECOLOGISTA', '10'),
(2579, 'RODOLFO REZENDE MENDONÇA', 'MÉDICO RADIOLOGISTA', '10'),
(2580, 'GABRYELLA TEIXEIRA DOS SANTOS', 'ENFERMEIRO SERVIÇOS DE VIGILÂNCIA EPIDEMIOLOGICA E NISP', '10'),
(2581, 'GISELLE DA SILVEIRA REIS', 'MEDICO GINECOLOGISTA/OBSTETRA', '10'),
(2582, 'SIRLEI DA MOTA FERREIRA SOUZA', 'AUXILIAR DE COZINHA', '10'),
(2583, 'THAYNARA DE OLIVEIRA SILVA', 'ENFERMEIRO SERVIÇOS DE VIGILÂNCIA EPIDEMIOLOGICA E NISP', '10'),
(2584, 'RUTH CARLA ALVES DA COSTA BORGES', 'MÉDICO GINECOLOGISTA', '11'),
(2585, 'SILVANA CARDOSO MARQUES', 'ENFERMEIRO ASSISTENCIAL EM OBSTETRICIA', '11'),
(2586, 'EDIMARA CARVALHO DE OLIVEIRA', 'TECNICO EM ENFERMAGEM', '12'),
(2587, 'CLAUDENICE ALVES FERREIRA', 'TÉCNICO DE ENFERMAGEM', '13'),
(2588, 'LUZIANA RODRIGUES', 'AUXILIAR DE COZINHA', '13'),
(2589, 'JULIANA STEPHANI DE SANTANA ALCANTARA CRISPIM', 'ENFERMEIRO ASSISTENCIAL EM OBSTETRICIA', '14'),
(2590, 'LORRAINY GABRIELLY FERREIRA DA SILVA', 'ASSISTENTE ADMINISTRATIVO', '15'),
(2591, 'ROSILENE PEREIRA DA SILVA', 'AUXILIAR DE ROUPARIA E LAVANDERIA', '15'),
(2592, 'THIAGO GUEDES SILVA', 'ASSISTENTE DE PLANEJAMENTO E GESTÃO DA QUALIDADE', '15'),
(2593, 'EDIGAR BARROZO DE MELO', 'AUXILIAR DE MANUTENÇÃO PREDIAL', '16'),
(2594, 'FERNANDA ROSA FLORES', 'ENFERMEIRO ASSISTENCIAL EM OBSTETRICIA', '16'),
(2595, 'THIANA SOUSA DOS SANTOS OLIVEIRA', 'TECNICO EM ENFERMAGEM', '16'),
(2596, 'VALDEANY RODRIGUES DA SILVA', 'TECNICO EM ENFERMAGEM', '16'),
(2597, 'EDUARDO SANTOS LOPES PONTES', 'MÉDICO GINECOLOGISTA', '17'),
(2598, 'DEBORA ADORNO MACEDO', 'MEDICO INTENSIVISTA EM NEONATOLOGIA', '17'),
(2599, 'EDUARDO SANTOS LOPES PONTES', 'DIRETOR TECNICO', '17'),
(2600, 'LINDAURA OLINA DOURADO DE MOURA', 'ANALISTA DE NIVEL SUPERIOR II', '18'),
(2601, 'AMAURI RUFINO DA COSTA', 'AUXILIAR DE ROUPARIA E LAVANDERIA', '19'),
(2602, 'PATRICIA LUCIENE DA SILVA ABREU', 'TECNICO EM ENFERMAGEM', '19'),
(2603, 'NECY PEREIRA DE SA SANTOS', 'AUXILIAR DE COZINHA', '20'),
(2604, 'POLLYANNA ALVES CARVALHO', 'ENFERMEIRO ASSISTENCIAL', '20'),
(2605, 'THALMA TIBURCIO VENANCIO GOULART', 'MEDICO NEONATOLOGISTA', '20'),
(2606, 'ANA CLARA ARAÚJO COSTA', 'MÉDICO GINECOLOGISTA', '21'),
(2607, 'ELDOM DE MEDEIROS SOARES', 'MÉDICO CLÍNICO GERAL', '21'),
(2608, 'WERICA RODRIGUES DA SILVA NUNES', 'FONOAUDIÓLOGO', '21'),
(2609, 'GABRIELLE MIGUEL CRUVINEL CAMARA CAVALCANTE', 'MEDICO ULTRASSONOGRAFISTA', '22'),
(2610, 'PATRICIA BORGES GOMES', 'MEDICO NEONATOLOGISTA', '22'),
(2611, 'ALZIRA RODRIGUES DOS SANTOS', 'AGENTE ADMINISTRATIVO', '23'),
(2612, 'BRAULINO FERREIRA DA CRUZ', 'TÉCNICO DE RADIOLOGIA', '23'),
(2613, 'FABIANE DE LIMA SOUZA SOARES', 'ENFERMEIRO', '23'),
(2614, 'LORENE ALMEIDA PINHEIRO DE BELEM', 'MÉDICO MASTOLOGISTA', '23'),
(2615, 'MARIA DO SOCORRO FERREIRA', 'TÉCNICO DE ENFERMAGEM', '23'),
(2616, 'GRASIANE BESSA TINELLI', 'MEDICO NEONATOLOGISTA', '23'),
(2617, 'MIRIAN TEREZINHA DA COSTA', 'TECNICO DE LABORATORIO DE ANALISES CLINICAS', '23'),
(2618, 'MATILDE LEAL', 'TÉCNICO DE ENFERMAGEM', '24'),
(2619, 'MARIUSA NERE DOS ANJOS', 'TECNICO EM ENFERMAGEM', '24'),
(2620, 'MARLY VITORINO DA SILVA ROSA', 'TECNICO EM ENFERMAGEM', '24'),
(2621, 'RAFAEL ALFAIA', 'MEDICO NEONATOLOGISTA', '24'),
(2622, 'VALGLESSIA FERREIRA SOUSA DA CONCEICAO', 'FONOAUDIÓLOGO', '24'),
(2623, 'PATRICIA MARIA DE SOUSA FREITAS', 'FARMACEUTICO/BIOQUIMICO', '25'),
(2624, 'LETÍCIA CARDOSO MOREIRA (2 contratos)', 'AUXILIAR EM SAÚDE', '26'),
(2625, 'YVANA DE CARVALHO RISPOLI', 'CIRURGIÃ DENTISTA', '26'),
(2626, 'IVANIR JESUS DA VEIGA', 'TECNICO EM ENFERMAGEM', '26'),
(2627, 'JESSICA FONSECA SILVA BARROS MACHADO', 'TECNICO EM ENFERMAGEM', '26'),
(2628, 'WILLIAN GUIDA DA COSTA', 'AUXILIAR DE ALMOXARIFADO', '26'),
(2629, 'MICHELLE CARNEIRO ALMEIDA', 'MEDICO NEONATOLOGISTA', '27'),
(2630, 'SARAH MARCAL REZIO FERREIRA', 'FISIOTERAPEUTA', '27'),
(2631, 'LIVIA CIPRIANO REIS ZAIDEM', 'MEDICO INTENSIVISTA EM NEONATOLOGIA', '28'),
(2632, 'LAYANE KELLY DE CASTRO DIAS', 'ANALISTA DE PLANEJAMENTO E GESTÃO DA QUALIDADE', '30'),
(2633, 'MARIA ANISIA DA SILVA SANTOS', 'AUXILIAR DE COZINHA', '30'),
(2634, 'MARIA DO ESPIRITO SANTO NUNES DE BRITO', 'TECNICO EM ENFERMAGEM', '30'),
(2635, 'ROSIMEIRE DOS SANTOS FERREIRA', 'LACTARISTA', '30'),
(2636, 'LILIAN JOSE DE OLIVEIRA', 'ASSISTENTE SOCIAL', '31');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aniversariantes`
--
ALTER TABLE `aniversariantes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aniversariantes`
--
ALTER TABLE `aniversariantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2637;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
