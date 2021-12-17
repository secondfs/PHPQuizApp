DROP TABLE IF EXISTS `answers`;
CREATE TABLE `answers` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` bigint unsigned NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `answers_question_id_foreign` (`question_id`),
  CONSTRAINT `answers_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `passings`;
CREATE TABLE `passings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_answers` int DEFAULT NULL,
  `total_answers` int NOT NULL DEFAULT '10',
  `answers_count` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `passings_nickname_unique` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `answers` (`id`, `answer`, `question_id`, `is_correct`) VALUES
(1, 'Non saepe quisquam assumenda voluptas debitis. Eum placeat totam incidunt ipsa.', 1, 0);
INSERT INTO `answers` (`id`, `answer`, `question_id`, `is_correct`) VALUES
(2, 'Similique sunt possimus ut nostrum sit. Accusantium cupiditate nobis error dolores laboriosam fugiat accusantium. Quae minima dolor amet.', 1, 0);
INSERT INTO `answers` (`id`, `answer`, `question_id`, `is_correct`) VALUES
(3, 'Magnam sapiente fuga harum id qui optio voluptatem. Perspiciatis consequatur accusantium voluptas odit et. Itaque accusantium doloremque iure non in sunt. Voluptatem quaerat qui dolore voluptas in est.', 1, 1);
INSERT INTO `answers` (`id`, `answer`, `question_id`, `is_correct`) VALUES
(4, 'Eius maiores unde ducimus voluptatibus corrupti similique. Omnis asperiores nobis repellendus et ut sint ab. Exercitationem id enim culpa porro assumenda quam perferendis.', 2, 0),
(5, 'Laboriosam cupiditate sed possimus dolor velit animi. Est nobis beatae accusantium hic est est. Sit numquam et tenetur maxime perferendis cum voluptatem. Officiis sint voluptatem esse enim quo consequatur tenetur qui.', 2, 0),
(6, 'Facilis harum fugit ut non occaecati fugit. In dolor laudantium quas nemo consequuntur. Et pariatur non sed voluptatem placeat rerum fugit. Exercitationem omnis exercitationem accusantium.', 2, 1),
(7, 'Quia quis natus at. Vero tenetur eius ipsa est reprehenderit beatae sunt beatae. Cum sit dicta enim rerum fugiat iusto illum dicta. Totam ut modi asperiores quae architecto quia sed iusto.', 3, 1),
(8, 'Rerum vitae deleniti aut enim alias qui distinctio. Pariatur et doloribus molestiae aut possimus unde.', 3, 0),
(9, 'Nostrum cupiditate exercitationem minima. Doloremque optio ut at. Voluptatem beatae aut natus pariatur cupiditate.', 3, 0),
(10, 'Iusto nisi ullam tempore neque. Eos totam dolorem et sit aut. Qui commodi autem delectus accusamus voluptas quia. Earum et sequi labore aut ullam sit.', 4, 0),
(11, 'Repellendus ut voluptas officiis ea quisquam explicabo. Veniam atque beatae quo beatae impedit ab. Impedit dicta exercitationem ab vero accusantium.', 4, 1),
(12, 'Nam debitis aut reiciendis dolorum architecto sunt. Ex et mollitia ut iusto molestias. Eius rerum atque et asperiores qui. Non error architecto eum voluptates voluptas.', 4, 1),
(13, 'Accusantium minima cum omnis repellendus. Consequatur et quo vel quibusdam corporis. Iure officia neque amet delectus.', 5, 1),
(14, 'Eum asperiores est odio incidunt aliquid assumenda voluptatem. Excepturi ullam quis voluptatum qui nihil. Quia iusto recusandae blanditiis. Esse qui ex fuga qui tenetur explicabo id.', 5, 1),
(15, 'Exercitationem est excepturi fugiat neque et. Laboriosam iure qui et fuga ut et sapiente. Et quia fugiat voluptatem qui atque.', 5, 0),
(16, 'Cum nobis alias omnis qui aut dolore. Aut mollitia velit enim aut et quis delectus. Nostrum ut rerum qui. Voluptas at voluptas non suscipit vel. Dolorem aut illum beatae sequi tenetur.', 6, 0),
(17, 'Dolores dolore velit sapiente occaecati. Quia maxime numquam possimus odit quia. Sit animi quod ducimus omnis. Et voluptas qui blanditiis molestiae expedita mollitia eos.', 6, 0),
(18, 'Iste natus officia aut voluptatum debitis ducimus aspernatur. Est ut amet ipsa in consequatur. Aut et alias aut eos fugiat dolores minima. In quis qui ut minus magni cupiditate eaque eligendi.', 6, 0),
(19, 'Possimus non quis voluptas doloribus. Nesciunt enim quae aut quia consequatur iste. Dolorum quidem quas consequatur et pariatur.', 7, 0),
(20, 'Suscipit doloremque necessitatibus cupiditate totam minima aut laboriosam. Aliquid qui ut at animi aspernatur adipisci. Fugiat numquam ipsum harum ullam autem doloribus aperiam.', 7, 1),
(21, 'Enim ullam sit odit vero amet fuga quas. Laboriosam ipsam sint blanditiis non reprehenderit.', 7, 0),
(22, 'Ut repudiandae ut in autem animi. Aut dolores nihil cum aliquam. Inventore fuga ab laboriosam voluptas et accusantium.', 8, 0),
(23, 'Tempore rerum sunt ipsa optio eum aliquam. Ea vel enim qui officia aperiam omnis. Veritatis nihil maiores dolore voluptatibus velit. Maxime sapiente id nemo sed vero veniam enim.', 8, 0),
(24, 'Tempore voluptatem et et asperiores totam beatae. Qui ipsa et et quo dolores. Molestiae eos non amet officia illum ut. Non officiis quidem voluptatem dolor corrupti.', 8, 1),
(25, 'Esse doloremque accusamus dolor nam praesentium soluta. Eaque et et ea. Nobis iusto cupiditate et ut quidem.', 9, 1),
(26, 'Laboriosam omnis aut et voluptas asperiores aut voluptas. Natus autem rerum itaque quo. Accusamus quia sunt est iure labore occaecati quis. Autem qui est blanditiis asperiores in fugit.', 9, 1),
(27, 'Dolores ad sint corrupti aperiam. Vero quia aut consequatur rerum dignissimos. Sequi odit placeat fugit. Exercitationem doloribus voluptas fugiat eius.', 9, 0),
(28, 'Dignissimos consequuntur fuga numquam nihil explicabo temporibus et. Animi et eum maxime cum tempore. Ipsam consectetur consequuntur libero fugit.', 10, 0),
(29, 'Enim quis harum non aliquid. Qui quia soluta omnis voluptatem alias reprehenderit. Officia officiis quod ea ut voluptatibus qui excepturi facilis. Possimus sed dolor eveniet incidunt. Et soluta dolorem omnis quasi.', 10, 0),
(30, 'Ea quia earum quia cumque qui molestiae. Et aut sunt autem rerum sit quas est. Labore odit et mollitia id labore sequi nemo facere.', 10, 0),
(31, 'Amet expedita voluptas tenetur molestias. Et non id magni aut. Harum vitae aspernatur voluptates illo odio.', 11, 0),
(32, 'In amet aut non. Culpa velit minus aut placeat quasi. Asperiores laboriosam delectus dicta qui excepturi cum.', 11, 1),
(33, 'Nulla sit rerum reprehenderit. Dolores similique voluptas minima quo qui provident non.', 11, 0),
(34, 'Voluptate et ex hic distinctio omnis quo. Dicta sapiente ad aspernatur eius. Et assumenda quidem velit eaque at quas.', 12, 1),
(35, 'Ad enim voluptas et voluptatem. Aut pariatur facilis nisi explicabo aut nisi laudantium est. Quas quos distinctio labore. Voluptates molestiae amet eos repellat.', 12, 1),
(36, 'Totam illum iure commodi quidem omnis eum quas minima. Ea explicabo placeat omnis totam est voluptate. Rerum inventore fugit optio porro possimus et. Placeat soluta ullam omnis voluptatem adipisci. Impedit expedita qui consequuntur consectetur.', 12, 0),
(37, 'Unde inventore assumenda impedit voluptatem id reprehenderit. Voluptas labore aut ex harum labore voluptatem quibusdam. Et quasi dolorum aut iusto recusandae dolorem et. Accusantium eos ut doloribus.', 13, 1),
(38, 'Voluptates incidunt consequatur est occaecati. Ut eligendi ut saepe modi eaque sed distinctio. Neque ut autem dolorum possimus nulla perferendis vero. Excepturi voluptas libero ipsam provident dicta.', 13, 1),
(39, 'Hic voluptas iste sint omnis explicabo nemo. Suscipit ut reprehenderit ut est et cumque quam. Consequatur facere non dolorum ut et quasi. Error aliquam totam dolorem sint dolorem ab.', 13, 1),
(40, 'Dignissimos magnam et ratione facilis nulla. Dolor consectetur corrupti perspiciatis voluptate earum. Iusto ea molestiae ipsa repudiandae quo quaerat quasi. Vitae perferendis eaque totam blanditiis.', 14, 0),
(41, 'Incidunt ipsam harum ipsam reprehenderit. Quis vel amet quia nulla dolorem. Sit suscipit perferendis explicabo quasi numquam magnam. Et fugit aut nihil soluta corporis consequatur.', 14, 1),
(42, 'Rerum nobis ullam temporibus repellat. Deleniti omnis praesentium fuga vitae dolores voluptas voluptatem officia. Repellendus laborum nemo voluptatum. Sint et soluta doloribus nostrum sit ut accusantium. Minus dolore rerum quia numquam qui porro quisquam.', 14, 1),
(43, 'Qui quia velit fugiat eos. Est rerum impedit dolor odio perspiciatis. Non dolor dolor architecto nihil alias vero.', 15, 1),
(44, 'Qui esse in sequi soluta. Magni mollitia et dolorem. Ipsa nobis sunt beatae nesciunt est sed dolorum. Sit adipisci molestias illum tenetur.', 15, 0),
(45, 'Sunt quaerat blanditiis iusto incidunt ut molestiae. Et esse praesentium sit dolorem quisquam quod. Quasi necessitatibus cumque vero dicta vel. Sit expedita rerum perspiciatis sit.', 15, 0),
(46, 'Aspernatur numquam provident est nisi. Amet eligendi totam assumenda mollitia fuga nihil sit. Sint blanditiis modi doloribus quo doloribus distinctio beatae. Illum pariatur ea dolor atque.', 16, 0),
(47, 'Laudantium ipsam architecto laborum vero hic. Quos reprehenderit ipsa quo magnam autem eum. Deserunt non possimus sit voluptas molestiae laborum.', 16, 0),
(48, 'Repellendus architecto quis non at deserunt. Corporis eum pariatur eum aut incidunt. Voluptate quidem omnis consequuntur eligendi.', 16, 1),
(49, 'Nam voluptatem cumque aliquid ut nostrum sint non commodi. Voluptas aut consectetur aut in minima. Unde ut eius quia corporis dolore voluptas voluptatum.', 17, 1),
(50, 'Sint facilis voluptatibus voluptas et similique tempora est tenetur. Corrupti aut esse magnam ad tempore. Dolor architecto deleniti vel repudiandae dolorem. Voluptatem dicta voluptatem sapiente reprehenderit enim quo possimus.', 17, 1),
(51, 'Voluptatem suscipit magni officia molestiae reprehenderit sit similique ipsum. Quia quo rerum repudiandae pariatur id sed quibusdam. Aut molestiae ad voluptatem vitae odio repellat nostrum aut.', 17, 0),
(52, 'Odio commodi non recusandae voluptas reprehenderit. Minus tempora ipsum cum qui omnis nisi aspernatur.', 18, 0),
(53, 'Hic autem optio illo dolorum sunt magnam qui rerum. Quas dolore accusantium eaque magnam. Ea fugiat soluta ut cupiditate et.', 18, 0),
(54, 'Laboriosam accusantium debitis dolor perspiciatis quas aut. Vel ab aspernatur alias necessitatibus. Porro consectetur nam id earum voluptatem ea.', 18, 1),
(55, 'Occaecati blanditiis voluptatem ipsam doloribus. Atque distinctio hic officiis quia ut et dolore eaque. Qui numquam rerum quis ullam eos. Totam iure voluptatem non mollitia et ipsam.', 19, 0),
(56, 'Dolores porro dolorem praesentium enim sed et. Architecto ut dolorum tempore nulla. Sunt et dolorum quas non vel.', 19, 1),
(57, 'Qui quod similique optio eius illo ea doloribus iste. Est in cumque minima consectetur esse. Est tempora consectetur beatae maxime deserunt. Deleniti incidunt expedita ut est hic nisi nesciunt dolor.', 19, 0),
(58, 'Blanditiis in reprehenderit et veniam. Harum neque aut quisquam quas similique ipsa numquam. Autem sapiente ullam at sint. Dolores assumenda ut ab sapiente impedit quam.', 20, 0),
(59, 'Iste voluptatum nobis et quidem doloremque. Atque magnam illo et dignissimos perferendis dicta quo. Porro cumque esse numquam in et eum eligendi. Perspiciatis sed saepe iusto quam temporibus. Vel suscipit id dolor incidunt modi non ut ducimus.', 20, 0),
(60, 'Commodi facilis aspernatur qui voluptate. Dignissimos pariatur et ex aut quo magni. Dolorem qui maiores rerum et. Numquam illum quo tempora dolores dolor doloribus nisi.', 20, 0);



INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_11_09_140300_create_questions_table', 1),
(6, '2021_11_09_142356_create_answers_table', 1),
(7, '2021_11_09_144117_create_passings_table', 1);







INSERT INTO `questions` (`id`, `title`) VALUES
(1, 'Quidem ducimus vero ex temporibus iusto quia.');
INSERT INTO `questions` (`id`, `title`) VALUES
(2, 'Voluptas fugit recusandae neque rem dolor reiciendis.');
INSERT INTO `questions` (`id`, `title`) VALUES
(3, 'Veniam iusto expedita voluptate velit.');
INSERT INTO `questions` (`id`, `title`) VALUES
(4, 'Voluptatem sequi officiis repudiandae commodi.'),
(5, 'Blanditiis veritatis laudantium error aut.'),
(6, 'Aut pariatur quas illum ut.'),
(7, 'Aperiam consectetur vero et consequuntur eligendi repellat minus.'),
(8, 'Vitae veritatis odio autem modi libero voluptates tenetur.'),
(9, 'Occaecati aut numquam commodi eaque voluptate.'),
(10, 'Minima autem minus laudantium repellat eos sequi quia.'),
(11, 'Perferendis sit velit corporis accusantium est voluptatem.'),
(12, 'Sit et et asperiores dolor ea autem voluptas.'),
(13, 'Consequatur consequatur tempore vitae tempore vitae et et.'),
(14, 'Rerum sed dignissimos iste molestiae voluptas quia sint.'),
(15, 'Sed illo quis modi et sed.'),
(16, 'Dolorem quo provident et autem id doloremque.'),
(17, 'Fugiat similique sed voluptatem adipisci.'),
(18, 'Voluptatem quis reprehenderit qui atque quasi eius in.'),
(19, 'Aut consectetur minus quo ut molestiae est sit veniam.'),
(20, 'Reprehenderit eveniet maiores consequatur quaerat amet.');

