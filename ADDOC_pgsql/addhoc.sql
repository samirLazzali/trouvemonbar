--
-- Database: `addhoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE company (
  id integer SERIAL,
  name VARCHAR NOT NULL,
  url VARCHAR DEFAULT '',
  id_user VARCHAR NOT NULL,
  PRIMARY KEY (id)
);

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE deposit (
  id integer SERIAL,
  id_user integer NOT NULL,
  date_creation timestamp NOT NULL DEFAULT current_timestamp,
  name VARCHAR NOT NULL,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table `deposit_contain`
--

CREATE TABLE deposit_contain (
  id integer SERIAL,
  id_deposit integer NOT NULL,
  id_directory integer NOT NULL,
  annotations VARCHAR NOT NULL,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table `deposit_model`
--

CREATE TABLE deposit_model (
  id integer SERIAL,
  id_deposit integer NOT NULL,
  id_type integer NOT NULL,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table `directory`
--

CREATE TABLE directory (
  id integer SERIAL,
  id_user integer NOT NULL,
  date_creation timestamp NOT NULL DEFAULT current_timestamp,
  name VARCHAR NOT NULL,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table `directory_contain`
--

CREATE TABLE directory_contain (
  id integer SERIAL,
  id_directory integer NOT NULL,
  id_file integer NOT NULL,
  name VARCHAR NOT NULL,
  date_added timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE employee (
  id_company integer NOT NULL,
  id_user integer NOT NULL
);


-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE file (
  id integer SERIAL,
  id_user integer NOT NULL,
  id_type integer NOT NULL,
  date_uploaded timestamp NOT NULL DEFAULT current_timestamp,
  address VARCHAR NOT NULL,
  PRIMARY KEY (id)
);


-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE type (
  id integer SERIAL,
  type VARCHAR NOT NULL,
  PRIMARY KEY (id)
);

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id`, `type`) VALUES
(1, 'Passport'),
(2, 'Visa'),
(3, 'Driving Licence'),
(4, 'Bank Details');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE user (
  id integer SERIAL,
  firstname VARCHAR NOT NULL,
  lastname VARCHAR NOT NULL,
  email VARCHAR NOT NULL,
  pwd VARCHAR NOT NULL,
  date_signedup timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (id)
);


