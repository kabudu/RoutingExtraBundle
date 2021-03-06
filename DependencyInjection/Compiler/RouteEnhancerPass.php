<?php

namespace Symfony\Cmf\Bundle\RoutingExtraBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * This compiler pass adds additional route enhancers
 * to the dynamic router.
 *
 * @author Daniel Leech <dan.t.leech@gmail.com>
 */
class RouteEnhancerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('symfony_cmf_routing_extra.dynamic_router')) {
            return;
        }

        $router = $container->getDefinition('symfony_cmf_routing_extra.dynamic_router');

        foreach ($container->findTaggedServiceIds('dynamic_router_route_enhancer') as $id => $attributes) {
            $router->addMethodCall('addRouteEnhancer', array(new Reference($id)));
        }
    }
}
