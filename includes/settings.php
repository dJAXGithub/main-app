<?php

//False: DEV - True: PROD
define("PROD_AMBIENCE", false);
 
error_reporting(E_ERROR);
//error_reporting(E_ALL);
ini_set("display_errors", !PROD_AMBIENCE);

//DEPLOY
define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME'].'/');
define("UPLOAD_CONTENT", "uploads/content/");
define("UPLOAD_USERS_PROVIDERS_AVATARS", "uploads/users_providers/avatar/");

//Tmp Upload files dir - Absolute path
if(PROD_AMBIENCE) define("UPLOAD_CONTENT_TEMP", "/storage1/");
else define("UPLOAD_CONTENT_TEMP", "/var/www/html/rhovit/trunk/tmp_uploads/");

define("UPLOAD_HEADER", "uploads/header/");
define("UPLOAD_CONTENT_FILM_SUBDIR", "film/");
define("UPLOAD_CONTENT_MUSIC_SUBDIR", "music/");
define("UPLOAD_CONTENT_COMIC_SUBDIR", "comic/");
define("UPLOAD_CONTENT_GAME_SUBDIR", "game/");
define("UPLOAD_CONTENT_SHOW_SUBDIR", "show/");
define("UPLOAD_CONTENT_BOOK_SUBDIR", "book/");
define("UPLOAD_USERS_PROVIDERS_HERO", "uploads/users_providers/network_hero_slides/");
define("DATE_NULL", "0000-00-00");
define("DATETIME_NULL", "0000-00-00 00:00:00");
define("UPLOAD_ADS", "uploads/adv_banners/");
define("UPLOAD_AFFILIATES", "uploads/affiliates/");
define("UPLOAD_USERS_PROVIDERS_STAFF_IMAGES", "uploads/users_providers/staff/");

// SECTIONS
define("SECTION_THENEW", "NEW");
define("SECTION_THECHOSENDAILY", "CHOSEN DAILY");
define("SECTION_THEFEATURED", "FEATURED");
define("SECTION_THEPOPULARS", "POPULARS");
define("SECTION_THEGRATIS", "GRATIS");
define("SECTION_THECITIES", "CITIES");
define("SECTION_THESHOUTOUTS", "SHOUT OUTS");
define("SECTION_THEOTHERSTUFFBY", "OTHER STUFF BY");
define("SECTION_THEMAINCHOSENDAILY", "MAIN CHOSEN DAILY");
define("SECTION_THEMAINFEATURED", "MAIN FEATURED");
define("SECTION_THEUNIVERSITIES", "UNIVERSITIES");

define("SECTION_ITEMLIMIT", 5);
define("SECTION_ITEMLIMIT_TYPE", 20);

// CONTENT TYPES
define("CONTENTTYPE_FILM", "film");
define("CONTENTTYPE_MUSIC", "music");
define("CONTENTTYPE_MUSIC_TRACK", "track");
define("CONTENTTYPE_SHOW_TRACK", "episode");
define("CONTENTTYPE_COMIC", "comic");
define("CONTENTTYPE_SHOW", "show");
define("CONTENTTYPE_GAME", "game");
define("CONTENTTYPE_BOOK", "book");
define("CONTENTTYPE_TRACK_ADD", "track_add");

// EXTRA CONTENT TYPES
define("CONTENTTYPE_TRACK", "track");

// CONTENT TYPES ALLOWED EXTS
define("CONTENTTYPE_FILM_ALLOWED_EXTS", "*.avi;*.mp4" );
define("CONTENTTYPE_MUSIC_ALLOWED_EXTS", "*.mp3");
define("CONTENTTYPE_COMIC_ALLOWED_EXTS", "*.pdf");
define("CONTENTTYPE_SHOW_ALLOWED_EXTS", "*.avi;*.mp4;*.MP4");
define("CONTENTTYPE_GAME_ALLOWED_EXTS", "*.rar;*.zip");
define("CONTENTTYPE_BOOK_ALLOWED_EXTS", "*.pdf");

//AMAZON CONSTANT
define("AMAZON_RHOVIT_BUCKET", "rhovit.com");
define("AMAZON_KEYPARID","APKAJIX4KOHE2W33WMYQ");
define("AMAZON_PEM_FILE_SIGN","../pk-APKAJIX4KOHE2W33WMYQ.pem");
define("AMAZON_RTMP_SERVER_URL","rtmp://s18zob07jibw8s.cloudfront.net/cfx/st");
define("SECONDS_TOKEN_TTL", "60");
define("AMAZON_DEBUG", false);

//AMAZON SMTP SES CREDENTIALS
define('AMAZON_SES_SMTP_SERVER','ssl://email-smtp.us-east-1.amazonaws.com');
//define('AMAZON_SES_SMTP_SERVER','tls://ses-smtp-user.20170126-182514');
define('AMAZON_SES_SMTP_USER','AKIAI5WD4N6AB5KO2VDQ');
define('AMAZON_SES_SMTP_PASS', 'AvVgKK7MwQd7+4mf4V9XII9hQWcHX8uwripbMxvAcPIN');

//FILES
define("MP4_EXT", "mp4");
define("MP3_EXT", "mp3");
define("PROMOTIONAL_FILENAME_SUBFIX", "_prom");
define("FILE_NOTATION_SEPARATOR", "/");
define("MAX_UPLOAD_FILE_SIZE_HUMAN_FORMAT", "MAX SIZE 1.5 Gb");
define('PDF_PAGES_PREVIEW', 15);
define('PDF_PAGES_PREVIEW_COMIC', 5);
define('STORAGE_UNIT_MB', "MB");
define('STORAGE_UNIT_GB', "GB");

//USER PROVIDER TYPES
define("USERPROVIDERTYPE_INDEPENDENT", 1);
define("USERPROVIDERTYPE_COMERCIAL", 2);
define("USERPROVIDERTYPE_NETWORK", 3);
define("USERPROVIDERTYPE_UNIVERSITY", 4);

//ADMIN SETTINGS
define("BACK_PAGESIZE", 20);
define("RENT_PERIOD", 24);
define("SITE_ADMIN_EMAIL","nicolasrk@gmail.com");
define("REVIEW_PAGESIZE", 5);

//CITIES
define("CITY_NEWYORK", 1);
define("CITY_LA", 2);

//EMAIL SETTINGS
//define("EMAIL_DEFAULT_FROM", "no-reply@rhovit.com");
define("EMAIL_DEFAULT_FROM", "info@rhovit.com");
define("EMAIL_DEFAULT_FROMNAME", "rhovit.com");
define("EMAIL_TEMPLATE_FOLDER", "templates/mail/");

//FACEBOOK CONSTANTS
define("FACEBOOK_APP_ID", "101280616605140");
define("FACEBOOK_APP_SECRET", "d53801b5fe4aafdb5b9fbdbcfa8ed377");

//IMAGES
define("IMG_PROM_SLIDE_WIDTH", 700);
define("IMG_PROM_SLIDE_HEIGHT", null);

//PAYMENT METHODS
define("PAYMENTMETHOD_DWOLLA", "dwolla");
define("PAYMENTMETHOD_WALLET", "wallet");
define("PAYMENTMETHOD_STRIPE", "stripe");

//DWOLLA DATA - TOKENS
define("DWOLLA_ID", "812-687-7195");
define("DWOLLA_APIKEY", "AdHXIX3MQw4iOzVyjc7blKnL6VtBpE2j+7oV+kdqPd4pgm0JnT");
define("DWOLLA_APISECRET", "8yymZoYjqwfmlrJVjM+v7ANXQI+iikVQJ3O9GfKbvOpjJzypLD");
define("DWOLLA_TOKEN", "w0Tf2sm6/IB5F4YGjzC/cAFGrgb5FP8d7a8Fp2y3pK/mgdiyBa");
define("DWOLLA_PIN", "4748");

//GOOGLE WALLET DATA
define("GOOGLEWALLET_URL", "https://sandbox.google.com/checkout/inapp/lib/buy.js"); // <script src="https://wallet.google.com/inapp/lib/buy.js"></script>
define("GOOGLEWALLET_SELLERID", "14440647102806603619");
define("GOOGLEWALLET_SELLERSECRET", "NRsjzGylT03nrFmvLlBN3Q");
define("GOOGLEWALLET_ORDERTYPEPURCHASE", "purchase");
define("GOOGLEWALLET_ORDERTYPESUBSCRIPTION", "subscription");

//STRIPE
/*
//LIVE
define('STRIPE_PUB_KEY','pk_live_TOx3Xl9eRwFZc6NORXazu88L');
define('STRIPE_SECRET_KEY','sk_live_yjM65Rn48ivQwOKtgyOZLjt4');
*/
//TEST
define('STRIPE_PUB_KEY','pk_test_GLi4vvVV9LiMO0hYnjRFYiQG');
define('STRIPE_SECRET_KEY','sk_test_d8POs34SFg2lfZtKJXwSrmCD');

define("INDEPENDENT_PROVIDER_EXTRA",9.99);
?>
