<?php

namespace App\Presenters;

use App\Repositories\UserRepository;
use Nette;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\RenderMode;


final class SignupPresenter extends BasePresenter {
    private $database;
    private $userRepository;

    public function __construct(Nette\Database\Context $database, UserRepository $userRepository) {
        $this->database = $database;
        $this->userRepository = $userRepository;
    }

    protected function createComponentRegistrationForm(): BootstrapForm
    {
        $form = new BootstrapForm;
        $form->renderMode = RenderMode::VERTICAL_MODE;
        $row = $form->addRow();
        $row->addCell(6)
            ->addText('username', 'Enter username...')
            ->setRequired('Please enter your username');


        $secondRow= $form->addRow();
        $secondRow->addCell(6)
            ->addPassword('password', 'Enter password...')
            ->setRequired('Please enter your password');


        $form->addSubmit('send', 'Registrovat');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(BootstrapForm $form, $data): void
    {
        // tady zpracujeme data odeslaná formulářem
        // $data->name obsahuje jméno
        // $data->password obsahuje heslo

        $this->userRepository->signUpUser($data->username, $data->password);


        $this->flashMessage('Byl jste úspěšně registrován.');
        $this->redirect('Homepage:');
    }

    public function renderDefault() {

    }

}
