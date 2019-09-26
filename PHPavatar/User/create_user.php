<?php
include 'vendor/autoload.php';
use App\Entity\User;
use App\Model\UserModel;
use App\Service\Avatar\SvgAvatarFactory;
use App\Service\Helpers\FileSystemHelper;
use Core\DB\Database;
use DI\ContainerBuilder;
use Symfony\Component\Dotenv\Dotenv;

if(!empty($_POST)) {

    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');

    $container = ContainerBuilder::buildDevContainer();
    $container->set('db.config', function(){
        $config = explode('##', $_ENV['DATABASE']);
        return [
            'host'=>$config[0],
            'dbname'=>$config[1],
            'user'=>$config[2],
            'password'=>$config[3]
        ];
    });

    dump($container->get('db.config'));

    $container->set(PDO::class, function($c){
        $config = $c->get('db.config');
        $pdo = new PDO('mysql:host='.$config['host'].';dbname='.$config['dbname'], $config['user'], $config['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $pdo->exec('SET NAMES UTF8');
        return $pdo;
    });

    var_dump($container->get(PDO::class));

    $pdo = $container->get(PDO::class);
    $db = new Database($pdo);
    $userModel = new UserModel($db);





    // Création d'un avatar
    $svg = SvgAvatarFactory::getAvatar(3,7);
    // Création d'un nom de fichier unique et aléatoire
    $filename = sha1(uniqid(rand(), true)) .'.svg';
    // Enregistrement du fichier SVG
    $fs = new FilesystemHelper();
    $fs->write('uploads/avatars/'. $filename, $svg);
    // Instanciation de la classe UserModel

    $dotenv = new Dotenv();
    $dotenv->load(__DIR__.'/.env');
    $config = explode('##', $_ENV['DATABASE']);
    dump($config);

//    $pdo = new  PDO( 'mysql:host=localhost; dbname=avatar', 'root', '',
//    $pdo = new  PDO( 'mysql:host='.$config[0].';dbname='.$config[1].''.$config[2].$config[3],
//        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
//    $pdo->exec('SET NAMES UTF8');

    try{
        $user = new User($_POST);
//        $userModel = new UserModel();
        $user->setAvatar($filename);
//        $userModel->insert($user->getEmail());
        $userModel->insert($user);

        // $userModel->create(
        //     $_POST['firstname'],
        //     $_POST['lastname'],
        //     $_POST['email'],
        //     $_POST['password'],
        //     $filename
        // );



//        $userModel->create($user->getFirstname(), $user->getLastname(), $user->getEmail(), $_POST['password'], $filename);
        
        dump('Insertion user OK, vérifier dans la BDD.');
        die;
    }
    catch (Exception $e){
        dump($e->getMessage());
        die;
    }


    // Insertion des données du formulaire dans la base de données

}
// Affichage
include 'create_user.phtml';
