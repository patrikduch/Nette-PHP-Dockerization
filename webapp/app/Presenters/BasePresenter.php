<?php

namespace App\Presenters;

use Nette\Application\UI\Presenter;

abstract class BasePresenter extends Presenter
{
    public function handleUserLogout() {
        $this->user->logout();
        $this->redirect('Homepage:');
    }
}