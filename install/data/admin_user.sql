INSERT INTO `users` (`registerdate`, `lastlogin`, `password_hash`, `password_pepper`, `username`, `email`, `email_hide`, `email_change`, `email_activate`, `role`, `is_active`, `is_locked`, `activation_code`, `activation_expires`, `banned`, `ban_reason`, `avatar`, `firstname`, `lastname`, `gender`, `town`, `birthday`, `facebook`, `twitter`, `twitch`, `steam`, `instagram`, `youtube`, `discord`, `userpic`, `homepage`, `about`, `pmgot`, `pmsent`, `visits`, `language`, `last_update`) VALUES
(CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '{{adminpass}}', '{{adminpepper}}', '{{adminuser}}', '{{adminmail}}', 1, '', '', 1, 1, 0, NULL, NULL, NULL, '', 'noavatar.png', '', '', 'select_gender', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', NULL);

INSERT INTO `user_role_assignments` (`assignmentID`, `userID`, `roleID`, `created_at`, `assigned_at`) 
VALUES ('', 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `contact` (`name`, `email`, `sort`) VALUES
('Administrator', '{{adminmail}}', 1);

INSERT INTO `settings` (
  `hptitle`, `hpurl`, `clanname`, `clantag`, `adminname`, `adminemail`, `since`,
  `webkey`, `seckey`, `closed`, `default_language`, `de_lang`, `en_lang`, `it_lang`,
  `keywords`, `description`, `modRewrite`, `startpage`
) VALUES (
  'Webspell-RM', '{{adminweburl}}', 'Mein Clan / Verein', '[RM]', '{{adminuser}}', '{{adminmail}}', 2025,
  'PLACEHOLDER_WEBKEY', 'PLACEHOLDER_SECKEY', 0, 'de', 1, 1, 1,
  'Clandesign, Webspell, Webspell-RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, plungin, mods, Webspellanpassungen, Modifikationen und Anpassungen und mehr!', 'Kostenlose Homepage erstellen mit Webspell-RM CMS: Einfach, schnell & kostenlos! In wenigen Minuten mit der eigenen Website online gehen.', 0, 'startpage'
);

INSERT IGNORE INTO `user_username` (`userID`, `username`) VALUES (1, '{{adminuser}}');

INSERT IGNORE INTO `settings_imprint` (`id`, `type`, `company_name`, `represented_by`, `tax_id`, `email`, `website`, `phone`, `disclaimer`) VALUES
(1, 'private', '{{adminuser}}', '', '', '{{adminmail}}', '{{adminweburl}}', '+49 123 4567890', '[[lang:de]] Dies ist ein deutscher Haftungsausschluss. [[lang:en]] This is an English disclaimer. [[lang:it]] Questo Ã¨ un disclaimer italiano.');
