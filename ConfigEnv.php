<?php

ini_set('display_errors', 1);
ini_set("error_reporting", E_ALL ^ E_DEPRECATED);

$config['sessionSalt'] = 'hubleto-project';

$config['accountUid'] = 'hubleto-project';
$config['accountFullName'] = 'My Company';

// dirs

$config['srcFolder'] = 'Q:/workspace/www/hubleto';
$config['rootFolder'] = 'Q:/workspace/www/hubleto/project';
$config['logFolder'] = 'Q:/workspace/www/hubleto/project/log';
$config['uploadFolder'] = 'Q:/workspace/www/hubleto/project/upload';

// urls
$config['rewriteBase'] = "/hubleto/project/";
$config['srcUrl'] = 'http://localhost/hubleto/project/vendor/hubleto/main';
$config['rootUrl'] = 'http://localhost/hubleto/project';
$config['uploadUrl'] = 'http://localhost/hubleto/project/upload';

// db
$config['db_host'] = 'localhost';
$config['db_user'] = 'root';
$config['db_password'] = '';
$config['db_name'] = 'my_hubleto';
$config['db_codepage'] = 'utf8mb4';
$config['global_table_prefix'] = '';

// smtp
$config['smtpHost'] = '';
$config['smtpPort'] = '';
$config['smtpEncryption'] = '';
$config['smtpLogin'] = '';
$config['smtpPassword'] = '';

// misc
$config['develMode'] = TRUE;
$config['language'] = 'en';
$config['premiumRepoFolder'] = '';
$config['externalAppsRepositories'] = [
  'MyCompany' => __DIR__ . '/apps/external/MyCompany'
];

$config['env'] = 'local-env';
