<?php

namespace Kit\Bundle\PayBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kit_pay');
        $rootNode->children()
            ->arrayNode('config')
                ->children()
                    ->arrayNode('alipay')
                        ->children()
                            ->booleanNode('use_sandbox')->defaultTrue()->end()
                            ->scalarNode('partner')->cannotBeEmpty()->end()
                            ->scalarNode('app_id')->cannotBeEmpty()->end()
                            ->enumNode('sign_type')->values(['RSA', 'RSA2'])->defaultValue('RAS')->end()
                            ->scalarNode('ali_public_key')->cannotBeEmpty()->end()
                            ->scalarNode('rsa_private_key')->cannotBeEmpty()->end()
                            ->arrayNode('limit_pay')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('notify_url')->cannotBeEmpty()->end()
                            ->scalarNode('return_url')->cannotBeEmpty()->end()
                            ->booleanNode('return_raw')->defaultTrue()->end()
                        ->end()
                     ->end()
                     ->arrayNode('weipay')
                        ->children()
                            ->booleanNode('use_sandbox')->defaultTrue()->end()
                            ->scalarNode('app_id')->cannotBeEmpty()->end()
                            ->scalarNode('mch_id')->cannotBeEmpty()->end()
                            ->scalarNode('md5_key')->cannotBeEmpty()->end()
                            ->scalarNode('app_cert_pem')->cannotBeEmpty()->end()
                            ->scalarNode('app_key_pem')->cannotBeEmpty()->end()
                            ->enumNode('sign_type')->values(['MD5', 'HMAC-SHA256'])->defaultValue('MD5')->end()
                            ->enumNode('fee_type')->values(['CNY'])->cannotBeEmpty()->end()
                            ->arrayNode('limit_pay')
                                ->prototype('scalar')->end()
                            ->end()
                            ->scalarNode('notify_url')->cannotBeEmpty()->end()
                            ->scalarNode('redirect_url')->cannotBeEmpty()->end()
                            ->booleanNode('return_raw')->defaultTrue()->end()
                        ->end()
                     ->end()
                ->end()
            ->end()
         ->end();
                    
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
