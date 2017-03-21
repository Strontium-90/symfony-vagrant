<?php
namespace Strontium\SymfonyVagrant\Kernel;

use Strontium\SymfonyVagrant\VagrantHelper;
use Symfony\Component\HttpKernel\Kernel;

abstract class VagrantAwareKernel extends Kernel
{

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if (VagrantHelper::isVagrantEnvironment()) {
            return sprintf('/dev/shm/%s/cache/%s', $this->getName(), $this->environment);
        }

        return parent::getCacheDir();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if (VagrantHelper::isVagrantEnvironment()) {
            return sprintf('/dev/shm/%s/logs', $this->getName());
        }

        return parent::getLogDir();
    }
}
