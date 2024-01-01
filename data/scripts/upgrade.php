<?php declare(strict_types=1);

namespace Generic;

use Omeka\Stdlib\Message;

/**
 * @var Module $this
 * @var \Laminas\ServiceManager\ServiceLocatorInterface $services
 * @var string $newVersion
 * @var string $oldVersion
 *
 * @var \Omeka\Mvc\Controller\Plugin\Messenger $messenger
 */
$plugins = $services->get('ControllerPluginManager');
$messenger = $plugins->get('messenger');

if (version_compare($oldVersion, '3.4.46', '<')) {
    $message = new Message(
        'The module Generic was replaced by modules Common and Easy Admin and kept only for compatibility until next Omeka S major version.' // @translate
    );
    $messenger->addWarning($message);
}
