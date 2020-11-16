<?php

namespace App\Presenters;

use App\Presenters\BasePresenter;
use Contributte\FormsBootstrap\BootstrapForm;
use Contributte\FormsBootstrap\Enums\RenderMode;

final class ProfileEditPresenter extends BasePresenter {


    public function renderDefault() {

    }


    protected function createComponentProfileEditForm(): BootstrapForm
    {
        $form = new BootstrapForm;
        $form->renderMode = RenderMode::VERTICAL_MODE;
        $row = $form->addRow();
        $row->addCell(6)
            ->addPassword('password', 'New password')
            ->setRequired('Please enter your new password');


        $secondRow= $form->addRow();
        $secondRow->addCell(6)
            ->addPassword('passwordVerification', 'Password verification')
            ->setRequired('Please enter your verification password');


        $form->addSubmit('send', 'Change password');
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
}