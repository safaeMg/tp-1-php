CREATE DATABASE my_form;

CREATE TABLE `my_table` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `jobs` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `resume` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;