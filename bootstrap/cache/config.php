<?php return array (
  'app' => 
  array (
    'name' => NULL,
    'version' => '7.1',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://canada777.com/',
    'timezone' => 'UTC',
    'date_format' => 'Y-m-d',
    'time_format' => 'H:i:s',
    'date_time_format' => 'Y-m-d H:i:s',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'key' => 'base64:V8er1MML6Tq0POF8KBQQwHBi3BYUciqsRn4BE5GAoOA=',
    'salt' => '9748104773',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'Proengsoft\\JsValidation\\JsValidationServiceProvider',
      23 => 'Anhskohbo\\NoCaptcha\\NoCaptchaServiceProvider',
      24 => 'VanguardLTE\\Providers\\HtmlServiceProvider',
      25 => 'Intervention\\Image\\ImageServiceProvider',
      26 => 'anlutro\\LaravelSettings\\ServiceProvider',
      27 => 'Jenssegers\\Agent\\AgentServiceProvider',
      28 => 'VanguardLTE\\Services\\Auth\\Api\\JWTServiceProvider',
      29 => 'VanguardLTE\\Providers\\AppServiceProvider',
      30 => 'VanguardLTE\\Providers\\AuthServiceProvider',
      31 => 'VanguardLTE\\Providers\\EventServiceProvider',
      32 => 'VanguardLTE\\Providers\\RouteServiceProvider',
      33 => 'jeremykenedy\\LaravelRoles\\RolesServiceProvider',
      34 => 'Yajra\\DataTables\\DataTablesServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Input' => 'Illuminate\\Support\\Facades\\Input',
      'Inspiring' => 'Illuminate\\Foundation\\Inspiring',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'JsValidator' => 'Proengsoft\\JsValidation\\Facades\\JsValidatorFacade',
      'Socialite' => 'Laravel\\Socialite\\Facades\\Socialite',
      'Form' => 'Collective\\Html\\FormFacade',
      'HTML' => 'Collective\\Html\\HtmlFacade',
      'Image' => 'Intervention\\Image\\Facades\\Image',
      'Settings' => 'anlutro\\LaravelSettings\\Facade',
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'Agent' => 'Jenssegers\\Agent\\Facades\\Agent',
      'DataTables' => 'Yajra\\DataTables\\Facades\\DataTables',
    ),
  ),
  'auth' => 
  array (
    'social' => 
    array (
      'providers' => 
      array (
        0 => '',
      ),
    ),
    'expose_api' => true,
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'api' => 
      array (
        'driver' => 'jwt',
        'provider' => 'users',
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'VanguardLTE\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'email' => 'emails.password.remind',
        'table' => 'password_resets',
        'expire' => 60,
      ),
    ),
  ),
  'blogetc' => 
  array (
    'blog_index_title' => 'Viewing blog',
    'blog_index_category_title' => 'View posts in: ',
    'include_default_routes' => true,
    'blog_prefix' => 'blog',
    'admin_prefix' => 'blog_admin',
    'use_custom_view_files' => false,
    'per_page' => 10,
    'image_upload_enabled' => true,
    'blog_upload_dir' => 'blog_images',
    'memory_limit' => '2048M',
    'user_model' => 'VanguardLTE\\User',
    'show_full_post_on_index' => false,
    'echo_html' => true,
    'strip_html' => false,
    'auto_nl2br' => true,
    'use_wysiwyg' => true,
    'image_quality' => 80,
    'image_sizes' => 
    array (
      'image_large' => 
      array (
        'w' => 1000,
        'h' => 700,
        'basic_key' => 'large',
        'name' => 'Large',
        'enabled' => true,
        'crop' => true,
      ),
      'image_medium' => 
      array (
        'w' => 600,
        'h' => 400,
        'basic_key' => 'medium',
        'name' => 'Medium',
        'enabled' => true,
        'crop' => true,
      ),
      'image_thumbnail' => 
      array (
        'w' => 150,
        'h' => 150,
        'basic_key' => 'thumbnail',
        'name' => 'Thumbnail',
        'enabled' => true,
      ),
    ),
    'captcha' => 
    array (
      'captcha_enabled' => true,
      'captcha_type' => 'WebDevEtc\\BlogEtc\\Captcha\\Basic',
      'basic_question' => 'What is the opposite of white?',
      'basic_answers' => 'black,dark',
    ),
    'rssfeed' => 
    array (
      'should_shorten_text' => true,
      'text_limit' => 100,
      'posts_to_show_in_rss_feed' => 10,
      'cache_in_minutes' => 60,
      'description' => 'Our blog post RSS feed',
      'language' => 'en',
    ),
    'comments' => 
    array (
      'type_of_comments_to_show' => 'built_in',
      'max_num_of_comments_to_show' => 1000,
      'save_ip_address' => true,
      'auto_approve_comments' => false,
      'save_user_id_if_logged_in' => true,
      'user_field_for_author_name' => 'name',
      'ask_for_author_email' => true,
      'require_author_email' => false,
      'ask_for_author_website' => true,
      'disqus' => 
      array (
        'src_url' => 'https://GET_THIS_FROM_YOUR_EMBED_CODE.disqus.com/embed.js',
      ),
    ),
    'search' => 
    array (
      'search_enabled' => false,
    ),
  ),
  'broadcasting' => 
  array (
    'default' => 'redis',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => NULL,
        'secret' => NULL,
        'app_id' => NULL,
        'options' => 
        array (
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'ttl' => 60,
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'D:\\00work\\06casino\\canada777\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
    ),
    'prefix' => 'laravel_cache',
  ),
  'captcha' => 
  array (
    'secret' => NULL,
    'sitekey' => NULL,
    'options' => 
    array (
      'timeout' => 30,
    ),
  ),
  'coinpayment' => 
  array (
    'public_key' => '5bbc98b8c8403791715809fb77e4ed0e64e46b1bc141c86a49c5276aa0cffe69',
    'private_key' => '525a4B4D6dE14063d965e3E172647E8d0a8Ab16eDcE192743cf2dB01cd927339',
    'middleware' => 
    array (
      0 => 'web',
    ),
    'ipn' => 
    array (
      'activate' => false,
      'config' => 
      array (
        'coinpayment_merchant_id' => '',
        'coinpayment_ipn_secret' => '',
        'coinpayment_ipn_debug_email' => '',
      ),
    ),
    'default_currency' => 'USD',
    'header' => 
    array (
      'default' => 'logo',
      'type' => 
      array (
        'logo' => '/coinpayment.logo.png',
        'text' => 'Your payment summary',
      ),
    ),
    'font' => 
    array (
      'family' => '\'Roboto\', sans-serif',
    ),
    'logos' => 
    array (
      'Bitcoin' => 'https://github.com/hexters/CoinPayment/blob/master/btc.png?raw=true',
    ),
    'coinpayment_merchant_id' => '3ea57eec46e9dcebcaf417c418b33fac',
    'coinpayment_ipn_secret' => 'SFYA3VY6T2B0WVE8UWLNM15U0TC6WT0K6PJUN10G07NDF4XLCH',
    'coinpayment_ipn_debug_email' => 'test@ya.ru',
    'add_min' => '1',
    'add_max' => '100',
    'header_type' => 'logo',
    'header_logo' => '/coinpayment.logo.png',
    'header_text' => 'Your Payment Summary',
    'menus' => 
    array (
      'Home' => 
      array (
        'url' => '/',
        'class_icon' => 'fa fa-home',
      ),
    ),
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => '*',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => false,
    'max_age' => false,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'database' => 'canada777',
        'prefix' => 'w_',
      ),
      'sqlite_memory' => 
      array (
        'driver' => 'sqlite',
        'database' => ':memory:',
        'prefix' => 'w_',
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => 'localhost',
        'port' => '3306',
        'database' => 'canada777',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => 'w_',
        'prefix_indexes' => true,
        'strict' => false,
        'engine' => NULL,
        'options' => 
        array (
          1000 => true,
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'host' => 'localhost',
        'port' => '5432',
        'database' => 'canada777',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'host' => 'localhost',
        'port' => '1433',
        'database' => 'canada777',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'prefix' => '',
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'predis',
      'cluster' => false,
      'default' => 
      array (
        'host' => '127.0.0.1',
        'port' => 6379,
        'database' => 0,
      ),
    ),
  ),
  'datatables' => 
  array (
    'search' => 
    array (
      'smart' => true,
      'multi_term' => true,
      'case_insensitive' => true,
      'use_wildcards' => false,
    ),
    'index_column' => 'DT_RowIndex',
    'engines' => 
    array (
      'eloquent' => 'Yajra\\DataTables\\EloquentDataTable',
      'query' => 'Yajra\\DataTables\\QueryDataTable',
      'collection' => 'Yajra\\DataTables\\CollectionDataTable',
      'resource' => 'Yajra\\DataTables\\ApiResourceDataTable',
    ),
    'builders' => 
    array (
    ),
    'nulls_last_sql' => '%s %s NULLS LAST',
    'error' => NULL,
    'columns' => 
    array (
      'excess' => 
      array (
        0 => 'rn',
        1 => 'row_num',
      ),
      'escape' => '*',
      'raw' => 
      array (
        0 => 'action',
      ),
      'blacklist' => 
      array (
        0 => 'password',
        1 => 'remember_token',
      ),
      'whitelist' => '*',
    ),
    'json' => 
    array (
      'header' => 
      array (
      ),
      'options' => 0,
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\00work\\06casino\\canada777\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\00work\\06casino\\canada777\\storage\\app/public',
        'url' => 'https://canada777.com//storage',
        'visibility' => 'public',
      ),
      'ftp' => 
      array (
        'driver' => 'ftp',
        'host' => 'ftp.example.com',
        'username' => 'your-username',
        'password' => 'your-password',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => NULL,
        'secret' => NULL,
        'region' => NULL,
        'bucket' => NULL,
        'url' => NULL,
      ),
      'rackspace' => 
      array (
        'driver' => 'rackspace',
        'username' => 'your-username',
        'key' => 'your-key',
        'container' => 'your-container',
        'endpoint' => 'https://identity.api.rackspacecloud.com/v2.0/',
        'region' => 'IAD',
        'url_type' => 'publicURL',
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
  ),
  'image' => 
  array (
    'driver' => 'gd',
  ),
  'jsvalidation' => 
  array (
    'view' => 'jsvalidation::bootstrap',
    'form_selector' => 'form',
    'focus_on_error' => true,
    'duration_animate' => 600,
    'disable_remote_validation' => false,
    'remote_validation_field' => '_jsvalidation',
    'escape' => false,
  ),
  'jwt' => 
  array (
    'secret' => 'aq1LOdXbvN4uJAUHNmdCileMzz8zxyPB',
    'keys' => 
    array (
      'public' => NULL,
      'private' => NULL,
      'passphrase' => NULL,
    ),
    'ttl' => 60,
    'refresh_ttl' => 20160,
    'algo' => 'HS256',
    'required_claims' => 
    array (
      0 => 'iss',
      1 => 'iat',
      2 => 'exp',
      3 => 'nbf',
      4 => 'sub',
      5 => 'jti',
    ),
    'persistent_claims' => 
    array (
    ),
    'lock_subject' => true,
    'leeway' => 0,
    'blacklist_enabled' => true,
    'blacklist_grace_period' => 0,
    'decrypt_cookies' => false,
    'providers' => 
    array (
      'jwt' => 'Tymon\\JWTAuth\\Providers\\JWT\\Namshi',
      'auth' => 'Tymon\\JWTAuth\\Providers\\Auth\\Illuminate',
      'storage' => 'Tymon\\JWTAuth\\Providers\\Storage\\Illuminate',
    ),
    'lottery' => 
    array (
      0 => 5,
      1 => 100,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
          1 => 'payment',
        ),
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'D:\\00work\\06casino\\canada777\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'payment' => 
      array (
        'driver' => 'single',
        'name' => 'payment-log',
        'path' => 'D:\\00work\\06casino\\canada777\\storage\\logs/payment.log',
        'level' => 'info',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'D:\\00work\\06casino\\canada777\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 7,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'ns557998.ip-54-39-52.net',
    'port' => '465',
    'from' => 
    array (
      'address' => 'support@canada777mails.com',
      'name' => 'Canada777.com',
    ),
    'encryption' => 'ssl',
    'username' => 'support@canada777mails.com',
    'password' => 'James007!@#',
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\00work\\06casino\\canada777\\resources\\views/vendor/mail',
      ),
    ),
  ),
  'payments' => 
  array (
    'piastrix' => 
    array (
      'id' => '1058',
      'key' => 'LlaNoah2tBceKAIpWgEt8rlJ7',
    ),
  ),
  'queue' => 
  array (
    'default' => 'database',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => 'your-public-key',
        'secret' => 'your-secret-key',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'roles' => 
  array (
    'connection' => NULL,
    'rolesTable' => 'roles',
    'roleUserTable' => 'role_user',
    'permissionsTable' => 'permissions',
    'permissionsRoleTable' => 'permission_role',
    'permissionsUserTable' => 'permission_user',
    'separator' => '.',
    'models' => 
    array (
      'role' => 'jeremykenedy\\LaravelRoles\\Models\\Role',
      'permission' => 'jeremykenedy\\LaravelRoles\\Models\\Permission',
    ),
    'pretend' => 
    array (
      'enabled' => false,
      'options' => 
      array (
        'hasRole' => true,
        'hasPermission' => true,
        'allowed' => true,
      ),
    ),
    'defaultMigrations' => 
    array (
      'enabled' => false,
    ),
    'defaultSeeds' => 
    array (
      'PermissionsTableSeeder' => true,
      'RolesTableSeeder' => true,
      'ConnectRelationshipsSeeder' => true,
      'UsersTableSeeder' => false,
    ),
    'rolesGuiEnabled' => false,
    'rolesGuiAuthEnabled' => true,
    'rolesGuiMiddlewareEnabled' => true,
    'rolesGuiMiddleware' => 'role:admin',
    'rolesGuiCreateNewRolesMiddlewareType' => 'role',
    'rolesGuiCreateNewRolesMiddleware' => 'admin',
    'rolesGuiCreateNewPermissionMiddlewareType' => 'role',
    'rolesGuiCreateNewPermissionsMiddleware' => 'admin',
    'bladeExtended' => 'layouts.app',
    'bladePlacement' => 'yield',
    'bladePlacementCss' => 'inline_template_linked_css',
    'bladePlacementJs' => 'inline_footer_scripts',
    'titleExtended' => 'template_title',
    'bootstapVersion' => '4',
    'bootstrapCardClasses' => '',
    'tooltipsEnabled' => true,
    'enablejQueryCDN' => true,
    'JQueryCDN' => 'https://code.jquery.com/jquery-3.3.1.min.js',
    'enableSelectizeJsCDN' => true,
    'SelectizeJsCDN' => 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js',
    'enableSelectizeJs' => true,
    'enableSelectizeJsCssCDN' => true,
    'SelectizeJsCssCDN' => 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.min.css',
    'enableFontAwesomeCDN' => true,
    'fontAwesomeCDN' => 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
    'builtInFlashMessagesEnabled' => true,
    'rolesApiEnabled' => false,
    'rolesAPIAuthEnabled' => true,
    'rolesAPIMiddlewareEnabled' => true,
    'rolesAPIMiddleware' => 'role:admin',
    'rolesAPICreateNewRolesMiddlewareType' => 'role',
    'rolesAPICreateNewRolesMiddleware' => 'admin',
    'rolesAPICreateNewPermissionMiddlewareType' => 'role',
    'rolesAPICreateNewPermissionsMiddleware' => 'admin',
    'enabledDatatablesJs' => false,
    'datatablesJsStartCount' => 25,
    'datatablesCssCDN' => 'https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
    'datatablesJsCDN' => 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
    'datatablesJsPresetCDN' => 'https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
    'laravelUsersEnabled' => false,
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
    ),
    'ses' => 
    array (
      'key' => NULL,
      'secret' => NULL,
      'region' => 'us-east-1',
    ),
    'stripe' => 
    array (
      'model' => 'VanguardLTE\\User',
      'key' => NULL,
      'secret' => NULL,
    ),
    'mailtrap' => 
    array (
      'default_inbox' => '58948',
      'secret' => NULL,
    ),
    'facebook' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => NULL,
    ),
    'twitter' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => NULL,
    ),
    'vkontakte' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => NULL,
    ),
    'odnoklassniki' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'client_public' => NULL,
      'redirect' => NULL,
    ),
    'google' => 
    array (
      'client_id' => NULL,
      'client_secret' => NULL,
      'redirect' => NULL,
    ),
    'authy' => 
    array (
      'key' => NULL,
    ),
  ),
  'session' => 
  array (
    'driver' => 'database',
    'lifetime' => 172800,
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\00work\\06casino\\canada777\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => false,
    'http_only' => false,
    'same_site' => NULL,
  ),
  'settings' => 
  array (
    'store' => 'json',
    'path' => 'D:\\00work\\06casino\\canada777\\storage/settings.json',
    'connection' => NULL,
    'table' => 'settings',
    'keyColumn' => 'key',
    'valueColumn' => 'value',
    'enableCache' => false,
    'forgetCacheByWrite' => true,
    'cacheTtl' => 15,
    'defaults' => 
    array (
      'foo' => 'bar',
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'D:\\00work\\06casino\\canada777\\resources\\views',
    ),
    'compiled' => 'D:\\00work\\06casino\\canada777\\storage\\framework\\views',
  ),
  'sluggable' => 
  array (
    'source' => NULL,
    'maxLength' => NULL,
    'maxLengthKeepWords' => true,
    'method' => NULL,
    'separator' => '-',
    'unique' => true,
    'uniqueSuffix' => NULL,
    'includeTrashed' => false,
    'reserved' => NULL,
    'onUpdate' => false,
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 94,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
  'feed' => 
  array (
    'use_cache' => false,
    'cache_key' => 'laravel-feed.https://canada777.com/',
    'cache_duration' => 3600,
    'escaping' => true,
    'use_limit_size' => false,
    'max_size' => NULL,
    'use_styles' => true,
    'styles_location' => NULL,
  ),
);
