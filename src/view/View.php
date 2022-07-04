<?php

namespace cotcotfarm\view;

use Exception;

class View
{

    private string $file;
    private string $t;

    public function __construct(string $action)
    {
        $this->file = 'src/view/' . $action . 'View.php';
    }

    // Génère et affiche la vue
    public function generate(string $data=""): void
    {
        // partie spécifique de la vue
        $content = $this->generateFile($this->file, array('content' => $data));

        //template
        $view = $this->generateFile('src/template/template.php', array('t' => $this->t, 'content' => $content));

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
}
