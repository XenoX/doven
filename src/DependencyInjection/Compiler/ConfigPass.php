<?php

namespace App\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class ConfigPass
 *
 * @package App\DependencyInjection\Compiler
 */
class ConfigPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $config = $container->getParameter('easyadmin.config');

        foreach($config['design']['menu'] as $k => $v) {
            if (!isset($v['role'])) {
                $config['design']['menu'][$k]['role'] = 'ROLE_MODO';
            }

            if (!isset($v['access'])) {
                $config['design']['menu'][$k]['access'] = true;
            }
        }

        $container->setParameter('easyadmin.config', $config);
    }
}