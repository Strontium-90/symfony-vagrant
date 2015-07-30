<?php
namespace Strontium\SymfonyVagrant\Kernel;

use Symfony\Component\HttpKernel\Kernel;

abstract class VagrantAwareKernel extends Kernel implements VagrantAwareKernelInterface
{
    /**
     * {@inheritdoc}
     */
    public static function isVagrantEnvironment()
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if (self::isVagrantEnvironment()) {
            return sprintf('/dev/shm/%s/cache/%s', $this->getName(), $this->environment);
        }

        return parent::getCacheDir();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if (self::isVagrantEnvironment()) {
            return sprintf('/dev/shm/%s/logs', $this->getName());
        }

        return parent::getLogDir();
    }
}
