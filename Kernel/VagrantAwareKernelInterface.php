<?php
namespace Strontium\SymfonyVagrant\Kernel;

interface VagrantAwareKernelInterface
{
    /**
     * @return boolean
     */
    public static function isVagrantEnvironment();
}
