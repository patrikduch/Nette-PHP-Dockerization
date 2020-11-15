<?php

namespace App\Presenters;

use App\Repositories\UserRepository;
use App\Services\Authenticator;
use App\Services\PasswordEncrypter;
use Nette;
use Nette\Application\UI\Form;

final class UserAuthPresenter extends Nette\Application\UI\Presenter {
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

        $this->authenticator->authenticate([$data->name, $data->password]);

        try {
            $this->user->login($data->name, $data->password);
        } catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage('The username or password you entered is incorrect.');
        }

        $this->flashMessage('Byl jste úspěšně přihlášen.');
        $this->redirect('Homepage:');
    }

    public function renderDefault() {

    }

}
