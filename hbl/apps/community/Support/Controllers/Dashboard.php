<?php

namespace HubletoApp\Community\Support\Controllers;

class Dashboard extends \HubletoMain\Core\Controllers\Controller {

  public function prepareView(): void
  {
    parent::prepareView();
    $this->setView('@HubletoApp:Community:Support/Dashboard.twig');
  }

}