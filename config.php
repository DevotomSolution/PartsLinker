<?php
// APPLICATION
define('APPLICATION', 'Catalog');

// HTTP
define('HTTP_SERVER', 'https://partslinkerv1.test/');

// DIR
define('DIR_OPENCART', 'C:/laragon/www/partslinkerv1/');
define('DIR_APPLICATION', DIR_OPENCART);
define('DIR_SYSTEM', DIR_OPENCART . 'system/');
define('DIR_STORAGE', DIR_OPENCART . 'storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/template/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

define('DIR_IMAGE', DIR_STORAGE . 'image/');

define('DIR_IMAGE_PRODUCT', DIR_IMAGE . 'product/');
define('DIR_IMAGE_VEHICLE4PARTS', DIR_IMAGE . 'vehicle4parts/');
define('DIR_IMAGE_CATEGORY', DIR_IMAGE . 'catalog/category/');
define('DIR_IMAGE_USER_LOGO', DIR_IMAGE . 'user_logo/');

define('DIR_STORAGE_RELATIVE', 'storage/');
define('DIR_IMAGE_RELATIVE', DIR_STORAGE_RELATIVE . 'image/');
define('DIR_IMAGE_USER_LOGO_RELATIVE', DIR_STORAGE_RELATIVE . 'image/user_logo/');
define('DIR_IMAGE_PRODUCT_RELATIVE', DIR_STORAGE_RELATIVE . 'image/product/');
define('DIR_IMAGE_CATEGORY_RELATIVE', DIR_STORAGE_RELATIVE . 'image/catalog/category/');
define('DIR_IMAGE_VEHICLE4PARTS_RELATIVE', DIR_STORAGE_RELATIVE . 'image/vehicle4parts/');
define('DIR_UPLOAD_RELATIVE', DIR_STORAGE_RELATIVE . 'upload/');

define('DIR_IMAGE_USER_LOGO_NAME', 'user_logo/');
define('DIR_IMAGE_PRODUCT_NAME', 'product/');
define('DIR_IMAGE_CATEGORY_NAME', 'catalog/category/');
define('DIR_IMAGE_VEHICLE4PARTS_NAME', 'vehicle4parts/');

define('VEHICLE4PARTS_SKU_PREFIX', 'VP');

define('MAX_IMAGE_WIDTH', 1200);
define('MAX_IMAGE_HEIGHT', 1200);

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'partslinkerv1');
define('DB_PORT', '3306');
define('DB_PREFIX', 'pl_');