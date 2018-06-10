<?php

namespace App\Controllers;

class IndexController extends BaseController {

    public function getIndex (){
        //global sirve para tomar la variable del scoope superior
        global $pdo;

        $query = $pdo->prepare('SELECT * FROM blog_posts ORDER BY ID DESC');
        $query->execute();

        $blogPosts = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $this->render ('index.twig', ['blogPosts' => $blogPosts]);
    }
}

?>