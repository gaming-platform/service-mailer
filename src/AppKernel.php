<?php
declare(strict_types=1);

namespace GamingPlatform\Mailer;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle;
use Symfony\Bundle\DebugBundle\DebugBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Bundle\WebProfilerBundle\WebProfilerBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use SymfonyBundles\JsonRequestBundle\SymfonyBundlesJsonRequestBundle;

class AppKernel extends BaseKernel
{
    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        return $this->getProjectDir() . '/var/logs';
    }

    /**
     * @inheritdoc
     */
    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new SymfonyBundlesJsonRequestBundle(),
            new DoctrineBundle(),
            new TwigBundle(),
            new MonologBundle()
        ];

        if (in_array($this->getEnvironment(), ['dev'], true)) {
            $bundles[] = new DebugBundle();
            $bundles[] = new WebProfilerBundle();
        }

        return $bundles;
    }

    /**
     * @inheritdoc
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getProjectDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
