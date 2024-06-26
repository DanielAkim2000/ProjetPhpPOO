<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit187d0a3605b3f4e53a06dc41d9d006b6
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Router\\' => 7,
        ),
        'D' => 
        array (
            'Database\\' => 9,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Router\\' => 
        array (
            0 => __DIR__ . '/../..' . '/routes',
        ),
        'Database\\' => 
        array (
            0 => __DIR__ . '/../..' . '/database',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Controllers\\AgentsController' => __DIR__ . '/../..' . '/src/Controllers/AgentsController.php',
        'App\\Controllers\\CiblesController' => __DIR__ . '/../..' . '/src/Controllers/CiblesController.php',
        'App\\Controllers\\ContactsController' => __DIR__ . '/../..' . '/src/Controllers/ContactsController.php',
        'App\\Controllers\\Controller' => __DIR__ . '/../..' . '/src/Controllers/Controller.php',
        'App\\Controllers\\MissionsController' => __DIR__ . '/../..' . '/src/Controllers/MissionsController.php',
        'App\\Controllers\\PaysController' => __DIR__ . '/../..' . '/src/Controllers/PaysController.php',
        'App\\Controllers\\PlanquesController' => __DIR__ . '/../..' . '/src/Controllers/PlanquesController.php',
        'App\\Exceptions\\NotFoundException' => __DIR__ . '/../..' . '/src/Exceptions/NotFoundException.php',
        'App\\Models\\Abstract\\Model' => __DIR__ . '/../..' . '/src/Models/Abstract/Model.php',
        'App\\Models\\Administrateurs' => __DIR__ . '/../..' . '/src/Models/Administrateurs.php',
        'App\\Models\\Agents' => __DIR__ . '/../..' . '/src/Models/Agents.php',
        'App\\Models\\Cibles' => __DIR__ . '/../..' . '/src/Models/Cibles.php',
        'App\\Models\\Contacts' => __DIR__ . '/../..' . '/src/Models/Contacts.php',
        'App\\Models\\Humain' => __DIR__ . '/../..' . '/src/Models/Humain.php',
        'App\\Models\\HumainofKgb' => __DIR__ . '/../..' . '/src/Models/HumainofKgb.php',
        'App\\Models\\Missions' => __DIR__ . '/../..' . '/src/Models/Missions.php',
        'App\\Models\\Pays' => __DIR__ . '/../..' . '/src/Models/Pays.php',
        'App\\Models\\Planques' => __DIR__ . '/../..' . '/src/Models/Planques.php',
        'App\\Models\\Specialitys' => __DIR__ . '/../..' . '/src/Models/Specialitys.php',
        'App\\Models\\Statuts' => __DIR__ . '/../..' . '/src/Models/Statuts.php',
        'App\\Models\\Typemission' => __DIR__ . '/../..' . '/src/Models/Typemission.php',
        'App\\Models\\Typeplanque' => __DIR__ . '/../..' . '/src/Models/Typeplanque.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Database\\DBConnection' => __DIR__ . '/../..' . '/database/DBConnection.php',
        'Router\\Route' => __DIR__ . '/../..' . '/routes/Route.php',
        'Router\\Router' => __DIR__ . '/../..' . '/routes/Router.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit187d0a3605b3f4e53a06dc41d9d006b6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit187d0a3605b3f4e53a06dc41d9d006b6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit187d0a3605b3f4e53a06dc41d9d006b6::$classMap;

        }, null, ClassLoader::class);
    }
}
