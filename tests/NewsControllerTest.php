<?php

    namespace cotcotfarm\tests;

    use PHPUnit\Framework\TestCase;
    use cotcotfarm\entities\News;
    use cotcotfarm\controller\NewsController;

    class NewsControllerTest extends TestCase
    {

        private $pdo;
        private $newsController;

        protected function setUp() : void
        {
          $this->pdo = new \PDO('pgsql:host=localhost;dbname=cotcotfarm', 'appluser', 'applusermdpadm', [
               \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
               \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
           ]);

           $this->newsController = new NewsController($this->pdo);
        }

        /**
         * @test
         * @throws \PDOException
         */
        public function testinsertNewsError() : void
        {
               $this->expectException(\PDOException::class);
          //etant donné une news sans titre
               $news = new News(0,"", "", "");
          //lorsque j'appelle la methode insertNews du controller news
               $this->newsController->insertNews($news);
           // alors une exception est trouvée avec le message "Erreur lors de l'insertion de la news"
        }
 
        /**
         * @test
         */
        public function testInsertNews() : void
        {
           //etant donné une news avec un titre, un contenu, un auteur et une date de publication
                $news = new News(0, "title", "content", "author", "2020-01-01");
           //lorsque j'appelle la methode insertNews du controller news
                $this->newsController->insertNews($news);
           //je m'attend lors de l'appelle à avoir un message de succes
                $this->assertEquals("News ajoutée avec succès", $this->newsController->getMessage());
        } 

        /**
         * @test
         * @throws \Exception
         */    
         public function testSelectNewsNoDataFound() : void
           {
                    $this->expectExceptionMessage("Aucune news trouvée");
               //etant donné une news avec un titre
                    $news = new News(0, "title not found","","author");
               //lorsque j'appelle la methode selectNews du controller news
                    $this->newsController->searchNews($news);
               // alors une exception est trouvée avec le message "aucune new trouvée"
          }
     
        /**
        * @test
        */
        public function testGetOneNews() : void
        {
           //etant donné un titre de news
               $news = new News(0, "title", "", "", "2020-01-01 00:00:00");
           //lorsque j'appelle la methode selectNews du controller news
               $news = $this->newsController->searchNews($news);
           //je m'attend en retour à avoir une news unique avec le titre=title, le contenu=content, l'auteur=author, la date de publication=2020-01-01
               $this->assertEquals("title", $news->getTitle());
               $this->assertEquals("content", $news->getContent());
               $this->assertEquals("author", $news->getAuthor());
               $this->assertEquals("2020-01-01 00:00:00", $news->getPublishedDate());
        }

        /**
        * @test
        */
        public function testGetSeveralNews() : void
        {
           //etant donné 5 news que j'insere dans la base via la function insertNews avec un titre, un contenu, un auteur et une date de publication
               $news1 = new News(0, "title2", "content2", "author2", "2020-01-02 00:00:00");
               $news2 = new News(0, "title3", "content3", "author3", "2020-01-03 00:00:00");
               $news3 = new News(0, "title4", "content4", "author4", "2020-01-04 00:00:00");
               $news4 = new News(0, "title5", "content5", "author5", "2020-01-05 00:00:00");
               $news5 = new News(0, "title6", "content6", "author6", "2020-01-06 00:00:00");

               $this->newsController->insertNews($news1);
               $this->newsController->insertNews($news2);
               $this->newsController->insertNews($news3);
               $this->newsController->insertNews($news4);
               $this->newsController->insertNews($news5);
           //lorsque j'appelle la methode GetSeveralNews du controller news, en lui donnant le nombre de news à récupérer (3 plus recentes)
               $news = $this->newsController->getSeveralNews(3);
           //je m'attend en retour de réucpérer un tableau de 3 news trié de la plus récente à la plus ancienne
               $this->assertEquals(3, count($news)); 
               $this->assertLessThan(strtotime($news[1]->getPublishedDate()), strtotime($news[2]->getPublishedDate()));  
           //nettoyage de la base pour prochaine execution    
               $this->newsController->deleteNews($news1);
               $this->newsController->deleteNews($news2);
               $this->newsController->deleteNews($news3); 
               $this->newsController->deleteNews($news4);
               $this->newsController->deleteNews($news5);
        }

        /**
         * @test
         */
        public function testUpdateNews() : void
        {
           //etant donné une news avec un titre, un contenu, un auteur et une date de publication
                $news = new News(0, "title","","");
           //alors, lorsque j'appelle la methode updateNews du controller news avec la news à modifié et un tableau contenant les news valeurs
                $this->newsController->updateNews($news, ["title" => "titleUpdate"]);
           //je m'attend en retour à avoir un message de succes
                $this->assertEquals("News modifiée avec succès", $this->newsController->getMessage());
          //je m'attend lorsque je recherche la news mise à jour à obtenir une news unique avec le titre=titleUpdate, le contenu=content, l'auteur=author, la date de publication=2020-01-01
                $newsVerif = new News(0, "titleUpdate", "","");
                $result = $this->newsController->searchNews($newsVerif);
                $this->assertEquals("titleUpdate", $result->getTitle());
                $this->assertEquals("content", $result->getContent());
                $this->assertEquals("author", $result->getAuthor());
                $this->assertEquals("2020-01-01 00:00:00", $result->getPublishedDate()); 
        }

          /**
          * @test
          * @throws \Exception
          */
            public function testUpdateNoDataFound() : void
               {
                     $this->expectException(\Exception::class);
               //etant donné une news avec un titre, un contenu, un auteur et une date de publication
                     $news = new News(0, "title not found","", "");      
               //lorsque j'appelle la methode updateNews du controller news
                     $this->newsController->updateNews($news);
               // alors une exception est trouvée avec le message "La news à mettre à jour n'a pas été trouvée"
               }
 
         /**
         * @test
         */
        public function testDeleteNews() : void
        {
           //etant donné un titre de news 
               $news = new News(0, "titleUpdate", "", "");
           //lorsque j'appelle la methode deleteNews du controller news
               $this->newsController->deleteNews($news);
           //je m'attend en retour à avoir un message de succes
               $this->assertEquals("News supprimée avec succès", $this->newsController->getMessage());
        }

        /**
         * @test
         * @throws \Exception
         */
        public function testDeleteNoDataFound() : void
        {
               $this->expectException(\Exception::class);
          //etant donné une news avec un titre
               $news = new News(0, "title not found","", "");              
          //lorsque j'appelle la methode deleteNews du controller news
               $this->newsController->deleteNews($news);
           // alors une exception est trouvée avec le message "Erreur lors de la suppression de la news" 
        } 

        protected function tearDown() : void
        {
            $this->pdo = null;
        }
    }