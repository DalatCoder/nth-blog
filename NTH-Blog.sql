CREATE TABLE `user` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `first_name` varchar(32),
  `last_name` varchar(128),
  `email` varchar(64),
  `password` varchar(128),
  `intro` tinytext,
  `profile` text,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime
);

CREATE TABLE `post` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `author_id` bigint NOT NULL,
  `parent_id` bigint,
  `title` varchar(256) NOT NULL,
  `meta_title` varchar(256),
  `slug` varchar(256) NOT NULL,
  `summary` tinytext,
  `content` text,
  `published_at` datetime,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime,
  `cover_image_id` bigint
);

CREATE TABLE `tag` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `meta_title` varchar(256),
  `slug` varchar(128) NOT NULL,
  `content` text,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime
);

CREATE TABLE `post_tag` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `post_id` bigint,
  `tag_id` bigint
);

CREATE TABLE `category` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `meta_title` varchar(256),
  `slug` varchar(128) NOT NULL,
  `content` text,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime
);

CREATE TABLE `post_category` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `post_id` bigint,
  `category_id` bigint
);

CREATE TABLE `post_comment` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `post_id` bigint NOT NULL,
  `parent_id` bigint,
  `content` text NOT NULL,
  `email` varchar(128),
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128),
  `author_id` bigint,
  `published_at` datetime,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime
);

CREATE TABLE `post_meta` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `post_id` bigint NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime
);

CREATE TABLE `media` (
  `id` bigint PRIMARY KEY AUTO_INCREMENT,
  `file_name` varchar(256) NOT NULL,
  `file_type` varchar(256) NOT NULL,
  `file_size` varchar(256) NOT NULL,
  `file_location` varchar(256) NOT NULL,
  `media_type` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT (now()),
  `updated_at` datetime NOT NULL DEFAULT (now()),
  `deleted_at` datetime
);

CREATE INDEX `post_index_0` ON `post` (`slug`);

CREATE INDEX `post_index_1` ON `post` (`author_id`);

CREATE INDEX `post_index_2` ON `post` (`parent_id`);

CREATE INDEX `post_index_3` ON `post` (`published_at`);

CREATE INDEX `post_tag_index_4` ON `post_tag` (`post_id`);

CREATE INDEX `post_tag_index_5` ON `post_tag` (`tag_id`);

CREATE INDEX `post_category_index_6` ON `post_category` (`post_id`);

CREATE INDEX `post_category_index_7` ON `post_category` (`category_id`);

CREATE INDEX `post_comment_index_8` ON `post_comment` (`post_id`);

CREATE INDEX `post_comment_index_9` ON `post_comment` (`parent_id`);

CREATE INDEX `post_comment_index_10` ON `post_comment` (`author_id`);

CREATE INDEX `post_comment_index_11` ON `post_comment` (`email`);

CREATE INDEX `post_meta_index_12` ON `post_meta` (`post_id`);

CREATE INDEX `post_meta_index_13` ON `post_meta` (`key`);

ALTER TABLE `post` ADD FOREIGN KEY (`deleted_at`) REFERENCES `post` (`summary`);
