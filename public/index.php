<?php
if (isset($_GET['db']) && $_GET['db'] == 1) {
    require_once 'adminer.php';
    exit;
}
if (isset($_GET['server'])) {
    require_once 'adminer.php';
    exit;
}

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
