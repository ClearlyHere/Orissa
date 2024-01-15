<?php

    namespace App\Code\Config;

    // Class configuration pour se connecter à la BDD
    // Test
    class Conf
    {
        // Attribut array $databases contenant les informations login à la BDD
        public static int $sessionDuration = 6000;
        static private array $database = array(
            'hostname' => 'localhost',
            'database' => 'starfish',
            'login' => 'root',
            'password' => ''
        );

        static private array $apiUrls = array(
            'apiHost' => 'https://taxref.mnhn.fr',
            'apiBasePath' => '/api'
        );

        static private string $baseUrl = 'http://localhost/Orissa';

        public static function getBaseUrl(): string
        {
            return self::$baseUrl;
        }

        static public function getApiBasePath(): string
        {
            return static::$apiUrls['apiHost'] . static::$apiUrls['apiBasePath'];
        }

        // Static getters to obtain the connection information
        static public function getHostname(): string
        {
            return static::$database['hostname'];
        }

        static public function getDatabase(): string
        {
            return static::$database['database'];
        }

        static public function getLogin(): string
        {
            return static::$database['login'];
        }

        static public function getPassword(): string
        {
            return static::$database['password'];
        }
    }
