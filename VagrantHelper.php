<?php
namespace Strontium\SymfonyVagrant;

/**
 * @author Aleksey Bannov <a.s.bannov@gmail.com>
 */
class VagrantHelper
{
    public static function isVagrantEnvironment()
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }
}
