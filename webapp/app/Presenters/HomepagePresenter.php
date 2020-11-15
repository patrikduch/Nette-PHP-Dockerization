<?php



namespace App\Presenters;

use App\Services\Authenticator;
use Nette;

use App\Repositories\ProjectDetailRepository;


final class HomepagePresenter extends Nette\Application\UI\Presenter
{
    private $clicked = false;
    private $projectDetailRepository;
    private $user;


    public function __construct(ProjectDetailRepository $projectDetailRepository)
    {
        $this->projectDetailRepository = $projectDetailRepository;
    }

    /* Signal */
    public function handleChangeClickState()
    {
        $this->clicked = !($this->clicked);

        if ($this->isAjax()) {
            $this->redrawControl('clicked_area'); // invalid snippet 'clicked_area'
        }
    }

    public function renderDefault()
    {
        $this->template->projectDetail = $this->projectDetailRepository->getProjectName();
        $this->template->clicked = $this->clicked;
        $this->template->isAuthenticated = $this->getUser()->isLoggedIn();
    }
}
