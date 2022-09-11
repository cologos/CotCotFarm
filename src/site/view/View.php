<?php

namespace cotcotfarm\site\view;

use Exception;

class View
{

    private string $file;
    private string $t;
    private string $ViewName;

    public function __construct(string $action)
    {
        if ($action != 'Accueil') {
            
            $this->file = 'src/site/view/' . $action . 'View.php';
            
        } else {
            $this->file = 'src/site/template/template.php';
        }  
        
        $this->setViewName($action);
    }

    // Génère et affiche la vue
    public function generate(array $data=array()): string
    {
        // Génère les élément de la page
        return $content = $this->generateFile($this->file, $data);
    }

    public function display(string $view): void{
        echo $view;
    }

    // Génère un fichier vue et renvoie le resultat produit
    /** @param array<string> $data */
    private function generateFile(string $file, array $data): string
    {
        if (file_exists($file)) {
            extract($data);
            //var_dump($data);

            // Demarrage de la mise en tempon
            ob_start();

            //inclue le fichier Vue
            require $file;

            // Fin de la mise en tempon
            return ob_get_clean();
        } else {
            throw new Exception('Fichier ' . $file . ' introuvable');
        }
    }

    public function __destruct()
    {
        unset($this->file);
        unset($this->t);
    }

    public function setViewName(string $name): void
    {
        $this->name = $name;
    }
        
    public function getViewName(): string
    {
        return $this->name;
    }
}
