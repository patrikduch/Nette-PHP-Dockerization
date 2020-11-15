<?php

namespace App\Presenters;

use App\Repositories\UserRepository;
use Nette;
use Nette\Application\UI\Form;

final class UserAuthPresenter extends Nette\Application\UI\Presenter {
    private $database;
    private $userRepository;

    public function __construct(Nette\Database\Context $database, UserRepository $userRepository) {
        $this->database = $database;
        $this->userRepository = $userRepository;
    }

    protected function createComponentLoginForm(): Form
    {
        $form = new Form;
        $form->addText('name', 'Jméno:')
            ->setRequired('Zadejte prosím jméno');
        $form->addPassword('password', 'Heslo:')
            ->setRequired('Zadejte prosim heslo');
        $form->addSubmit('send', 'Přihlásit se');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(Form $form, $data): void
    {
        // tady zpracujeme data odeslaná formulářem
        // $data->name obsahuje jméno
        // $data->password obsahuje heslo



        $this->flashMessage('Byl jste úspěšně přihlášen.');
        $this->redirect('Homepage:');
    }

    public function renderDefault() {

    }

}
