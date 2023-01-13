<?php

namespace Alura\Doctrine\Helper;

use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;

class EntityManagerCreator
{
    public static function createEntityManager(): EntityManager
    {
        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: array(__DIR__."/.."),
            isDevMode: true
        );

        $cacheDirectory = __DIR__ . '/../../var/cache';

        //Cacheia o mapeamento das entidades
        $config->setMetadataCache(new PhpFilesAdapter(
            namespace: 'metadata_cache',
            directory: $cacheDirectory
        ));

        //Cacheia o mapeamento das querys
        $config->setQueryCache(new PhpFilesAdapter(
            namespace: 'query_cache',
            directory: $cacheDirectory
        ));

        /**
         * Cacheia o mapeamento das resultados
         * Evitar usar ao máximo
         * Se usar evite usar localmente pode se usar algo como o memcache, remdist,CouchBase, Doctrine (sim no próprio banco)
         * Pense em querys que podem ser compartilhadas entre servidores lowbalence, por isso têm que armazenar de forma compartilhada
         *
         * As query devem ser marcadas como cacheadas como em list-students
         *
         */
        $config->setResultCache(new PhpFilesAdapter(
            namespace: 'result_cache',
            directory: $cacheDirectory
        ));

        $consoleOutput = new ConsoleOutput(ConsoleOutput::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $logMiddleware = new Middleware($consoleLogger);
        $config->setMiddlewares([$logMiddleware ]);

        /* SQL Lite
        $conn = array(
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        );
        */
        $conn = array(
            'driver' => 'pdo_pgsql',
            'host' => 'localhost',
            'port' => '5433',
            'dbname' => 'alura-studens',
            'user' => 'postgres',
            'password' => 'Se111111',
        );

        // obtaining the entity manager
        return EntityManager::create($conn, $config);
    }
}
