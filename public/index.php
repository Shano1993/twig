<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Loader\FilesystemLoader;

require_once '../vendor/autoload.php';

$loader = new FilesystemLoader('../templates');

$twig = new Environment($loader, [
    'debug' => true,
    'strict_variables' => true,
    // 'cache' => '../var/cache',
]);

$twig->addExtension(new DebugExtension());

class User {
    public string $prenom;
    public string $nom;
    public int $age;
    public array $hobbies;
    public bool $hasJob;

    public function __construct(string $prenom, string $nom, int $age, bool $working)
    {
        $this->prenom = $prenom;
        $this->nom = $nom;
        $this->age = $age;
        $this->hobbies = ['Walking', 'Reading'];
        $this->hasJob = $working;
    }
}

$john = new User('John', 'Doe', 36, true);
echo $twig->render('home.html.twig', [
    'user' => $john,
]);