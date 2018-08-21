<?php

namespace CommonBundle\Extension;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

abstract class BaseExtension extends Extension
{
    const YML_EXTENSION = 'yml';

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = $this->createConfigLoader($container, 'config');

        foreach ($this->getConfigNamesList() as $name) {
            $loader->load($name);
        }
    }

    /**
     * @return string[]
     */
    protected function getConfigNamesList(): array
    {
        $files = [];

        $configPath = $this->getTargetExtensionDirectory()  . '/../Resources/config';
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($configPath, false));

        foreach ($iterator as $item) {
            if ($item->isFile() && $item->getExtension() === self::YML_EXTENSION) {
                $files[] = str_replace($configPath . '/', '', $item->getPathname());
            }
        }

        return $files;
    }

    /**
     * @param ContainerBuilder $container
     * @param string $resourceDirectory
     * @return LoaderInterface
     */
    protected function createConfigLoader(ContainerBuilder $container, $resourceDirectory): LoaderInterface
    {
        return
            new YamlFileLoader(
                $container,
                new FileLocator(
                    strtr(
                        '{targetExtensionDirectory}/../Resources/{resourceDirectory}',
                        [
                            '{targetExtensionDirectory}' => $this->getTargetExtensionDirectory(),
                            '{resourceDirectory}' => $resourceDirectory,
                        ]
                    )
                )
            );
    }

    /**
     * @param ContainerBuilder $container
     * @return string
     */
    protected function resolveEnvironment(ContainerBuilder $container): string
    {
        return $container->getParameter('kernel.environment');
    }

    /**
     * @return string
     */
    private function getTargetExtensionDirectory(): string
    {
        return dirname((new ReflectionClass(get_called_class()))->getFileName());
    }
}
