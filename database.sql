-- Adminer 4.8.1-dev MySQL 5.7.24 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `tb_category`;
CREATE TABLE `tb_category` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_category` (`id`, `category`) VALUES
(2,	'Tak Berkategori'),
(3,	'kategori_1'),
(4,	'kategori_2'),
(5,	'Pendidikan');

DROP TABLE IF EXISTS `tb_information`;
CREATE TABLE `tb_information` (
  `id` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `address` text NOT NULL,
  `facebook_name` varchar(255) DEFAULT NULL,
  `facebook_link` text,
  `instagram_name` varchar(255) DEFAULT NULL,
  `instagram_link` text,
  `youtube_name` varchar(255) DEFAULT NULL,
  `youtube_link` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_information` (`id`, `name`, `email`, `phone`, `address`, `facebook_name`, `facebook_link`, `instagram_name`, `instagram_link`, `youtube_name`, `youtube_link`, `created_at`, `updated_at`) VALUES
('4c3709a795337216e2fd10899b9576d9',	'Yayasanku',	'yayasanku@gmail.com',	'0881-0262-04776',	'Ds Bolorejo Kauman Tulungagung',	'yayasanku_fb',	'',	'yayasanku_ig',	'https://www.instagram.com/',	'',	'',	'2021-12-05 20:04:37',	'2021-12-05 20:04:37');

DROP TABLE IF EXISTS `tb_post`;
CREATE TABLE `tb_post` (
  `id` varchar(64) NOT NULL,
  `author` varchar(255) NOT NULL,
  `type` varchar(64) NOT NULL,
  `category` varchar(64) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `img_cover` varchar(128) NOT NULL,
  `file` varchar(128) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `modifier` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_post` (`id`, `author`, `type`, `category`, `title`, `content`, `img_cover`, `file`, `created_at`, `updated_at`, `modifier`) VALUES
('2a1bf88f9ab6cfa2ad9c1c3047b5cfaa',	'Admin',	'Berita',	'kategori_1',	'Postingan 1',	'&lt;p&gt;Berita pertama&lt;/p&gt;',	'1639191124_img-1.jpg',	NULL,	'2021-12-02 17:00:08',	'2021-12-11 09:52:04',	'Yayak'),
('6c39aa4e3379a8d91f968992ce7ed490',	'Yayak',	'Pengumuman',	'Tak Berkategori',	'Coba alert',	'&lt;p&gt;Coba alert&lt;/p&gt;\r\n',	'1639226051_wp2174483-acadia-national-park-wallpapers.jpg',	NULL,	'2021-12-09 11:09:13',	'2021-12-11 19:34:11',	'Yayak'),
('3516e378baee3245dbab6c2a98a7615a',	'Yayak',	'Berita',	'Tak Berkategori',	'Lorem Ipsum',	'&lt;h1&gt;&lt;tt&gt;&lt;big&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&lt;/big&gt;&lt;/tt&gt;&lt;/h1&gt;\r\n\r\n&lt;blockquote&gt;\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;quot;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&amp;quot;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...&amp;quot;&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n\r\n&lt;p&gt;&lt;samp&gt;What is Lorem Ipsum?&amp;nbsp;&lt;/samp&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;nbsp;&lt;/p&gt;\r\n',	'1639204505_img-3.jpg',	NULL,	'2021-12-09 18:30:51',	'2021-12-11 18:19:24',	'Yayak'),
('25631148073eea8806ad5b0e0049733b',	'Taka A',	'Berita',	'Pendidikan',	'Coba Posting Berita Lorem Ipsum Dolor Sit Amet',	'&lt;blockquote&gt;\r\n&lt;p&gt;&amp;quot;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&amp;quot;&lt;/p&gt;\r\n\r\n&lt;p&gt;&amp;quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...&amp;quot;&lt;/p&gt;\r\n&lt;/blockquote&gt;\r\n\r\n&lt;p&gt;&lt;samp&gt;What is Lorem Ipsum?&amp;nbsp;&lt;/samp&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum&lt;/p&gt;\r\n',	'1639205656_wp1865910-indonesia-wallpapers.jpg',	NULL,	'2021-12-11 13:54:16',	'2021-12-11 18:24:33',	'Yayak'),
('ae23683afa64e04f39252d0bf92363ad',	'Taka A',	'Artikel',	'Tak Berkategori',	'Mencoba Postingan Artikel',	'&lt;h1&gt;Lorem Ipsum&lt;/h1&gt;\r\n\r\n&lt;h2&gt;What is Lorem Ipsum?&lt;/h2&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;\r\n',	'1639277608_wp1865910-indonesia-wallpapers.jpg',	NULL,	'2021-12-12 09:53:28',	'2021-12-12 09:53:58',	'Yayak');

DROP TABLE IF EXISTS `tb_type`;
CREATE TABLE `tb_type` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_type` (`id`, `type`) VALUES
(1,	'Berita'),
(2,	'Pengumuman'),
(3,	'Artikel'),
(8,	'Kategori baru');

DROP TABLE IF EXISTS `tb_user`;
CREATE TABLE `tb_user` (
  `id` varchar(32) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` varchar(16) NOT NULL,
  `img` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tb_user` (`id`, `name`, `email`, `phone`, `password`, `role`, `img`, `created_at`, `updated_at`, `author`) VALUES
('d35d41f42977ce26466f888ea8c809c8',	'SuperAdmin',	'superadmin@gmail.com',	'08111111111111',	'$2y$10$bCcNdF.WJXthyIIiMLXPm.5Lq7UVjMmHpgbbFhpzZYfg.LStNw1Tq',	'SuperAdmin',	'default.png',	'2021-12-08 18:21:11',	'2021-12-12 09:57:27',	'SuperAdmin'),
('5baf058ea74463a4893bf1ead7e9700d',	'Taka A',	'taka@gmail.com',	'+6282233863080',	'$2y$10$zn5YdoQYEvYnGggAxf1TXuh.uu30RavuRZTNcCQlKvRHhVoU5SAWm',	'Admin',	'1638964194_gambar.jpg',	'2021-12-08 18:49:54',	'2021-12-08 18:56:27',	'Yayak'),
('64add8bb18c8ea613e9370afcf3f89c7',	'Coba',	'coba@gmail.com',	'+6282233863080',	'$2y$10$9BB36BLXbZ.TW/qfNmZkFOOkWOLgCjPNhr0BAo3h2211aEJzTgeP2',	'Admin',	'default.png',	'2021-12-08 19:00:28',	'2021-12-08 19:00:28',	'Yayak'),
('ce2379d1f32e3f395fa991efa97dd22b',	'Nano',	'nano@gmail.com',	'+6282233863080',	'$2y$10$7BAsotclVaz9YHqXa6spqO3PGn1f5WgQmp03f8rsq2XUc8IJrfMa.',	'Admin',	'default.png',	'2021-12-09 18:38:09',	'2021-12-09 18:38:19',	'Yayak'),
('25190383b3153ea1f11847e6d02ce798',	'Ginantaka',	'yayaktaka@gmail.com',	'+6282233863080',	'$2y$10$6XawJqJeIh6xaGcIu.ugu.eM3t7aVRRjnyd5Cex/ZpVGZ./UR3IDq',	'Admin',	'default.png',	'2021-12-09 19:50:31',	'2021-12-09 19:53:04',	'Yayak');

-- 2021-12-12 02:59:09