<?php

namespace App\src\Controller;

use App\src\Entity\Article;
use App\src\Controller\TwigController;

class ArticleController extends TwigController
{
    public function index()
    {
        $article = new Article;
        $articles = $article->getArticles();
        echo $this->twig->render("article/index.html.twig", [
            'articles' => $articles,
            'data' => 'Bienvenue sur le controller Article'
        ]);
    }

    public function view($params)
    {
        $getArticle = new Article;
        $getArticle->id = $params;
        //Renvoi un tableau (OBJ) d'une ligne = FETCH
        $article = $getArticle->getArticleById();
        var_dump($article);
        echo $this->twig->render("article/index.html.twig", [
            'article' => $article,
            'params' => $params,
            'data' => 'Bienvenue sur le controller Article/view'
        ]);
    }
}
