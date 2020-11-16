<?php

namespace App\Presenters;

use App\Repositories\UserRepository;
use App\Services\Authenticator;
use App\Services\PasswordEncrypter;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\RenderMode;
use Nette;

final class UserAuthPresenter extends BasePresenter {
    private $authenticator;
    private $database;
    private $passwordEncrypter;
    private $userRepository;

    public function __construct(Nette\Database\Context $database, UserRepository $userRepository,
                                Authenticator $authenticator, PasswordEncrypter  $passwordEncrypter) {
        $this->authenticator = $authenticator;
        $this->database = $database;
        $this->passwordEncrypter = $passwordEncrypter;
        $this->userRepository = $userRepository;
    }

    protected function createComponentLoginForm(): BootstrapForm
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


        $form->addSubmit('send', 'Login in');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        return $form;
    }

    public function formSucceeded(BootstrapForm $form, $data): void
    {
        // tady zpracujeme data odeslaná formulářem
        // $data->name obsahuje jméno
        // $data->password obsahuje heslo

        $this->authenticator->authenticate([$data->username, $data->password]);

        try {
            $this->user->login($data->username, $data->password);
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage('The username or password you entered is incorrect.');
        }

        //$this->flashMessage('Byl jste úspěšně přihlášen.');
        $this->redirect('Homepage:');
    }

    public function renderDefault() {

    }


}
