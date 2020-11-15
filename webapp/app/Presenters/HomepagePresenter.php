<?php



namespace App\Presenters;

use Nette;

use App\Repositories\ProjectDetailRepository;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{

    private $clicked = false;
    private $projectDetailRepository;

    public function __construct(Nette\Database\Context $database, ProjectDetailRepository $projectDetailRepository) {
        $this->projectDetailRepository = $projectDetailRepository;
    }


    /* Signal */
    public function handleChangeClickState() {
        $this->clicked = !($this->clicked);

        if ($this->isAjax()) {
            $this->redrawControl('clicked_area'); // invalid snippet 'clicked_area'
        }
    }

    public function renderDefault() {
        $this->template->projectDetail = $this->projectDetailRepository;
        $this->template->clicked = $this->clicked;
    }

}
