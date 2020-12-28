<?php declare(strict_types=1);

namespace App\Controller;

use App\Document\Post;
use App\Document\Product;
use App\Document\User;
use App\Faker\PostFaker;
use Doctrine\ODM\MongoDB\DocumentManager;
use Faker\Generator;
use Faker\Provider\Internet;
use Faker\Provider\Lorem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MongoDbTestController extends AbstractController
{
    /**
     * @Route("/mongo/db/test", name="mongo_db_test")
     */
    public function index(DocumentManager $documentManager): Response
    {
        $product = new Product();
        $product->setName('Penis-Hadouekn!');
        $product->setPrice('199.00');

        $documentManager->persist($product);
        $documentManager->flush();

        dump($product->getId()); die;

        return $this->render('mongo_db_test/index.html.twig', [
            'controller_name' => 'MongoDbTestController',
        ]);
    }

    /**
     * @Route("/mongo/get", name="mongo_get")
     */
    public function getData(DocumentManager $documentManager)
    {

        $product = $documentManager->getRepository(Product::class)->findAll();
        dump($product);
        die;
    }

    /**
     * @Route("/mongo/post/create", name="create_post")
     */
    public function mongoPostCreate(DocumentManager $documentManager)
    {
        $user = new User;
        $user->setEmail('asdf@'. Internet::freeEmailDomain());


        for ($i = 0; $i <= 3; $i++) {
            $post = new Post();
            $post->setText(Lorem::sentence());
            $user->addPost($post);
        }
        
        $documentManager->persist($user);
        $documentManager->flush();


        $posts = $documentManager->getRepository(User::class)->findAll();
        dump($posts);

        die;
    }
}
