<?php
require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;

$host = 'http://localhost:9515'; // puerto estándar de chromedriver
$capabilities = DesiredCapabilities::chrome();

// Opcional: Ejecutar en modo headless (sin abrir ventana)
$capabilities->setCapability('goog:chromeOptions', [
    'args' => ['--headless', '--disable-gpu', '--window-size=1280,800']
]);

$driver = RemoteWebDriver::create($host, $capabilities);

// Abre Google
$driver->get('http://localhost/Sistema_Gestion_Citas_Medicas/');

// Muestra el título
echo "Título: " . $driver->getTitle() . "\n";

// Cierra el navegador
$driver->quit();