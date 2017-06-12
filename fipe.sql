SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `fipe`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fp_ano`
--

CREATE TABLE IF NOT EXISTS `fp_ano` (
  `id_ano` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_modelo` int(11) NOT NULL,
  `codigo_fipe` varchar(10) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `combustivel` varchar(100) NOT NULL,
  `valor` double(10,2) NOT NULL,
  PRIMARY KEY (`id_ano`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48631 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fp_marca`
--

CREATE TABLE IF NOT EXISTS `fp_marca` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_marca` int(11) NOT NULL,
  `marca` varchar(50) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_marca` (`codigo_marca`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Extraindo dados da tabela `fp_marca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `fp_modelo`
--

CREATE TABLE IF NOT EXISTS `fp_modelo` (
  `codigo_modelo` int(11) NOT NULL AUTO_INCREMENT,
  `codigo_marca` int(11) NOT NULL,
  `codigo_fipe` varchar(10) NOT NULL,
  `modelo` varchar(100) NOT NULL,
  PRIMARY KEY (`codigo_modelo`),
  UNIQUE KEY `codigo_modelo` (`codigo_modelo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7174 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
