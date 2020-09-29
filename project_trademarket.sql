-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 29 sep. 2020 à 10:58
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `project_trademarket`
--

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(20) NOT NULL,
  `senderId` int(11) NOT NULL,
  `receiverId` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `dateSended` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `senderId`, `receiverId`, `message`, `dateSended`) VALUES
(1, 2, 1, 'Bonjour, je suis très intéressé par votre  article sur votre profile.', '2020-09-29 12:14:51'),
(2, 1, 2, 'Bonjour, pas de problème, je vous l\'envoie.', '2020-09-29 12:15:12'),
(3, 3, 2, 'Bonjour, j\'aimerais acquérir votre article 2', '2020-09-29 12:46:58');

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `id` int(15) NOT NULL,
  `ownerId` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `picture` varchar(200) DEFAULT NULL,
  `addingDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`id`, `ownerId`, `name`, `description`, `picture`, `addingDate`) VALUES
(2, 1, 'Article', 'description de l\'article ', '29092020_1004271400x500.png', '2020-09-29 12:03:22'),
(3, 1, 'Autre article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat urna ante, ut pharetra dolor ultricies vitae. Donec sapien eros, sagittis ac nunc aliquam, commodo fermentum leo. Sed eget aliquam diam, id pretium est. Morbi dapibus purus ut velit suscipit convallis. Sed efficitur dignissim nisl, eget venenatis est consequat ac. Aliquam cursus ex ac enim scelerisque, commodo aliquet nibh posuere. Phasellus lacinia congue mauris, eget dignissim risus facilisis eu. Praesent luctus turpis ac velit lacinia, tristique ultricies magna ultrices. Fusce est arcu, cursus ut magna vel, congue egestas lacus. Nunc mollis, elit a accumsan efficitur, ipsum sapien vestibulum leo, sed feugiat magna quam sit amet nibh. Aliquam pellentesque pharetra orci ac ullamcorper. Etiam vitae arcu nisi. Nunc mauris turpis, malesuada a eleifend id, lobortis eu diam. ', '29092020_1005161400x500.png', '2020-09-29 12:05:16'),
(4, 1, 'Encore un autre article', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat urna ante, ut pharetra dolor ultricies vitae. Donec sapien eros, sagittis ac nunc aliquam, commodo fermentum leo. Sed eget aliquam diam, id pretium est. Morbi dapibus purus ut velit suscipit convallis. Sed efficitur dignissim nisl, eget venenatis est consequat ac. Aliquam cursus ex ac enim scelerisque, commodo aliquet nibh posuere.', '29092020_1006551600x400.png', '2020-09-29 12:06:55'),
(5, 2, 'Article 1 ', 'Description de l\'article 1\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat urna ante, ut pharetra dolor ultricies vitae. Donec sapien eros, sagittis ac nunc aliquam, commodo fermentum leo.', '29092020_1013212300x150.png', '2020-09-29 12:13:21'),
(6, 2, 'Article2 ', 'description de l\'article 2', '29092020_1013512300x150.png', '2020-09-29 12:13:51'),
(7, 2, 'Article 3 ', 'Description de l\'article 3 Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat urna ante, ut pharetra dolor ultricies vitae. Donec sapien eros, sagittis ac nunc aliquam, commodo fermentum leo. Sed eget aliquam diam, id pretium est. Morbi dapibus purus ut velit suscipit convallis. Sed efficitur dignissim nisl, eget venenatis est consequat ac. Aliquam cursus ex ac enim scelerisque, commodo aliquet nibh posuere. Phasellus lacinia congue mauris, eget dignissim risus facilisis eu. Praesent luctus turpis ac velit lacinia, tristique ultricies magna ultrices. Fusce est arcu, cursus ut magna vel, congue egestas lacus. Nunc mollis, elit a accumsan efficitur, ipsum sapien vestibulum leo, sed feugiat magna quam sit amet nibh. Aliquam pellentesque pharetra orci ac ullamcorper. Etiam vitae arcu nisi. Nunc mauris turpis, malesuada a eleifend id, lobortis eu diam. ', '29092020_1014112400x500.png', '2020-09-29 12:14:11'),
(8, 3, 'Article 1', 'Description rapide del\'article', '29092020_1047383750x750.png', '2020-09-29 12:47:38'),
(9, 3, 'Article 2', 'Description rapide l\'article ', '29092020_1047563600x400.png', '2020-09-29 12:47:56');

-- --------------------------------------------------------

--
-- Structure de la table `support`
--

CREATE TABLE `support` (
  `id` int(10) NOT NULL,
  `userId` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `request` text NOT NULL,
  `startDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `support`
--

INSERT INTO `support` (`id`, `userId`, `title`, `request`, `startDate`, `status`) VALUES
(1, 2, 'Problème de connexion', 'Bonjour, j\'ai un problème.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat urna ante, ut pharetra dolor ultricies vitae. Donec sapien eros, sagittis ac nunc aliquam, commodo fermentum leo. Sed eget aliquam diam, id pretium est. Morbi dapibus purus ut velit suscipit convallis. Sed efficitur dignissim nisl, eget venenatis est consequat ac. Aliquam cursus ex ac enim scelerisque, commodo aliquet nibh posuere. Phasellus lacinia congue mauris, eget dignissim risus facilisis eu. Praesent luctus turpis ac velit lacinia, tristique ultricies magna ultrices. Fusce est arcu, cursus ut magna vel, congue egestas lacus. Nunc mollis, elit a accumsan efficitur, ipsum sapien vestibulum leo, sed feugiat magna quam sit amet nibh. Aliquam pellentesque pharetra orci ac ullamcorper. Etiam vitae arcu nisi. Nunc mauris turpis, malesuada a eleifend id, lobortis eu diam. ', '2020-09-29 12:15:40', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `supportmessages`
--

CREATE TABLE `supportmessages` (
  `id` int(15) NOT NULL,
  `requestId` int(10) NOT NULL,
  `userId` int(11) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(200) NOT NULL,
  `avatar` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'default.png',
  `status` varchar(6) NOT NULL DEFAULT 'member'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nickname`, `firstName`, `lastName`, `email`, `password`, `avatar`, `status`) VALUES
(1, 'TestAdmin', 'Admin', 'Admin', 'admin@g.com', '$2y$10$vHROL723Bo23/g8CpzKqEOzQsvRe8hT1oYhHBQOWCmR2WWBhvQvoq', 'default.png', 'admin'),
(2, 'CBo9', 'Clément', 'B', 'clement@g.com', '$2y$10$R1m/guXmLjJsOw7G2FfYEuuH90aIb0e1KwdR7rPnMSRra29G7aqmS', 'User_avatarCBo9400x500.png', 'member'),
(3, 'Pierrot', 'Pierre', 'Paul', 'pierre@g.com', '$2y$10$I0qfrRoH2ausVc7cIxqjSO29KhhfdcTEhbIYTeFSt1ROMKHe2Ptyq', 'default.png', 'member');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderId` (`senderId`),
  ADD KEY `receiverId` (`receiverId`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ownerId` (`ownerId`);

--
-- Index pour la table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Index pour la table `supportmessages`
--
ALTER TABLE `supportmessages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requestId` (`requestId`),
  ADD KEY `requestId_2` (`requestId`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `supportmessages`
--
ALTER TABLE `supportmessages`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `user's received chats` FOREIGN KEY (`receiverId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user's send chats` FOREIGN KEY (`senderId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `user's items` FOREIGN KEY (`ownerId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `support`
--
ALTER TABLE `support`
  ADD CONSTRAINT `user's requestsd` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `supportmessages`
--
ALTER TABLE `supportmessages`
  ADD CONSTRAINT `support` FOREIGN KEY (`requestId`) REFERENCES `support` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
