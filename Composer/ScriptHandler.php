<?php
namespace Strontium\SymfonyVagrant\Composer;

use Composer\Script\CommandEvent;
use Sensio\Bundle\DistributionBundle\Composer\ScriptHandler as BaseHandler;

class ScriptHandler extends BaseHandler
{
    /**
     * Warming up cache on Vagrant environment in synced with host machine folder. It's required for correctly working
     * of Symfony plugin for PHPStorm.
     *
     * @param $event CommandEvent A instance
     */
    public static function cacheWarmupOnVagrant(CommandEvent $event)
    {
        $options = self::getOptions($event);
        $appDir = $options['symfony-app-dir'];

        if (null === $appDir) {
            return;
        }
        require_once $appDir.'/AppKernel.php';

        if (!in_array('Strontium\SymfonyVagrant\Kernel\VagrantAwareKernelInterface', class_implements('AppKernel'))
            || !\AppKernel::isVagrantEnvironment()
        ) {
            return;
        }

        $oldVagrant = getenv('VAGRANT');
        $oldHome = getenv('HOME');
        putenv('VAGRANT=NOTVAGRANT');
        putenv('HOME=/home/notvagrant');

        $event->getIO()->write("Warming up cache on Vagrant machine in synced with host machine folder");
        static::executeCommand($event, $appDir, 'cache:warmup --env=dev', $options['process-timeout']);

        putenv('VAGRANT='.$oldVagrant);
        putenv('HOME='.$oldHome);
    }
}
