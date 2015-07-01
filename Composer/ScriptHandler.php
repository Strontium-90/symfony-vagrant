<?php
namespace Strontium\SymfonyVagrant\Composer;

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
        $consoleDir = self::getConsoleDir($event, 'clear the cache');

        if (null === $consoleDir) {
            return;
        }
        require_once $consoleDir.'/AppKernel.php';
        if (!\AppKernel::isVagrantEnvironment()) {
            return;
        }

        $oldVagrant = getenv('VAGRANT');
        $oldHome = getenv('HOME');
        putenv('VAGRANT=NOTVAGRANT');
        putenv('HOME=/home/notvagrant');

        $event->getIO()->write("Warming up cache on Vagrant machine in synced with host machine folder");
        static::executeCommand($event, $consoleDir, 'cache:warmup --env=dev', $options['process-timeout']);

        putenv('VAGRANT='.$oldVagrant);
        putenv('HOME='.$oldHome);
    }
}
