<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    private $clicked = false;

    private $database;

    public function __construct(Nette\Database\Context $database) {
        $this->database = $database;
    }


    /* Signal */
    public function handleChangeFoo() {
        $this->clicked = !($this->clicked);

        if ($this->isAjax()) {
            $this->redrawControl('clicked_area'); // invalid snippet 'clicked_area'
        }
    }

    public function renderDefault() {
        $this->template->projectDetail = $this->database->table('ProjectDetail')->limit(1);
        $this->template->clicked = $this->clicked;
    }




}
