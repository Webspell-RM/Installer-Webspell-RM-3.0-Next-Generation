INSERT INTO `users` (`registerdate`, `lastlogin`, `password_hash`, `password_pepper`, `username`, `email`, `email_hide`, `email_change`, `email_activate`, `role`, `is_active`, `is_locked`, `activation_code`, `activation_expires`, `banned`, `ban_reason`, `avatar`, `firstname`, `lastname`, `gender`, `town`, `birthday`, `facebook`, `twitter`, `twitch`, `steam`, `instagram`, `youtube`, `discord`, `userpic`, `homepage`, `about`, `pmgot`, `pmsent`, `visits`, `language`, `last_update`) VALUES
(UNIX_TIMESTAMP(), UNIX_TIMESTAMP(), '{{adminpass}}', '{{adminpepper}}', '{{adminuser}}', '{{adminmail}}', 1, '', '', 1, 1, 0, NULL, NULL, NULL, '', 'noavatar.png', '', '', 'select_gender', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 0, '', NULL);

INSERT INTO `user_role_assignments` (`assignmentID`, `userID`, `roleID`, `created_at`, `assigned_at`) 
VALUES ('', 1, 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO `contact` (`name`, `email`, `sort`) VALUES
('Administrator', '{{adminmail}}', 1);

INSERT IGNORE INTO `settings` (`hptitle`, `hpurl`, `clanname`, `clantag`, `adminname`, `adminemail`, `sball`, `topics`, `posts`, `latesttopics`, `latesttopicchars`, `messages`, `register_per_ip`, `sessionduration`, `closed`, `imprint`, `default_language`, `insertlinks`, `search_min_len`, `max_wrong_pw`, `captcha_math`, `captcha_bgcol`, `captcha_fontcol`, `captcha_type`, `captcha_noise`, `captcha_linenoise`, `bancheck`, `spam_check`, `detect_language`, `spammaxposts`, `spamapiblockerror`, `date_format`, `time_format`, `modRewrite`, `startpage`, `forum_double`, `profilelast`, `de_lang`, `en_lang`, `it_lang`, `birthday`, `keywords`, `description`) VALUES
('Webspell-RM', '{{adminweburl}}', 'Clan Name', 'MyClan', '{{adminuser}}', '{{adminmail}}', 30, 20, 10, 10, 18, 20, 1, 0, 0, 1, 'de', 1, 3, 10, 2, '#FFFFFF', '#000000', 2, 100, 10, 1564938159, 0, 0, 0, 0, 'd.m.Y', 'H:i', 0, 'startpage', 1, 10, 1, 1, 1, 0, 'Clandesign, Webspell, Webspell-RM, Wespellanpassungen, Webdesign, Tutorials, Downloads, Webspell-rm, rm, addon, plugin, Templates Webspell Addons, plungin, mods, Webspellanpassungen, Modifikationen und Anpassungen und mehr!', 'Kostenlose Homepage erstellen mit Webspell-RM CMS: Einfach, schnell & kostenlos! In wenigen Minuten mit der eigenen Website online gehen.');

INSERT INTO `user_username` (`userID`, `username`) VALUES (1, '{{adminuser}}');