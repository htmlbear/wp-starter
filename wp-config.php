<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'wp_starter');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'K;d?[5Y,2S#&xZb:D8*^X@=9X-a,/|zscRzmc5+;lt4 xYTHF?oB.z3BMeJ- up>');
define('SECURE_AUTH_KEY',  'c7C!*F=zZph/AF*z0o=T[%z$JZ(hQYS{cwi]c^=XPbeM93xT.jM;SQik?Na@@-@4');
define('LOGGED_IN_KEY',    '(-^l/Pr/[oqL,Q<2NLg^4@H=g%o4IcD?IATHu:+:.Vl,@j.!CA6?K&6?o1qO( +J');
define('NONCE_KEY',        'Qb@-L!?<PLOW7l7_%lAHSqdi;<}qqG`C75ZYFZ((%rWT^l!lG%k)YGJhR6S;.w}g');
define('AUTH_SALT',        'TCMu%`vBD/T<.OE3 QQSS*3XRYaC>6:Gh7+Yxw]}/Ai{^U`?VVS2!Cb7!;(^*(p^');
define('SECURE_AUTH_SALT', ' LGiR`Z.4yB[Xfu7zY7B/}7i9,#.uteR<7v9DonxAH7}qtF5U8.jX)[tpAjr,98;');
define('LOGGED_IN_SALT',   ' 3i.|R^;<EWU*u3=.)5O,!n-#lNn_aHxF.fj8e<S4VfVDeWi^y9eHGWe!4MHA`* ');
define('NONCE_SALT',       '=|V93eM:9[a8Gwsy|UnBxJ}!yz?52C&.mxr%7H{S^xa8<1L6tIkrRC+ .9r<8Dq{');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);
define('WP_POST_REVISIONS', 5);
define('AUTOSAVE_INTERVAL', 600);
define( 'EMPTY_TRASH_DAYS', 3 );
/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
