<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Auth\UserBundle\AuthUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Smath\ProductoBundle\SmathProductoBundle(),
            new Smath\ClienteBundle\SmathClienteBundle(),
            new Smath\BaseBundle\SmathBaseBundle(),
            new Smath\EmpresaBundle\SmathEmpresaBundle(),
            new Smath\DashboardBundle\SmathDashboardBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Smath\CalendarioVisitaBundle\SmathCalendarioVisitaBundle(),
            new Acme\UtilBundle\AcmeUtilBundle(),
            new Smath\VentasBundle\SmathVentasBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
