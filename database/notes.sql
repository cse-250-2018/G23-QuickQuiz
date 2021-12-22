CREATE TABLE `notes` (
  `ID` int(11) NOT NULL,
  `Author` varchar(255) NOT NULL,
  `Course` varchar(50) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Time` datetime NOT NULL DEFAULT current_timestamp(),
  `Size` decimal(3,3) NOT NULL
)
