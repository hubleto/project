<?php

namespace HubletoApp\Community\Cloud\Controllers;

class DeactivateSubscriptionRenewal extends \HubletoMain\Core\Controllers\Controller {

  public function prepareView(): void
  {
    parent::prepareView();
    $this->hubletoApp->saveConfig('subscriptionRenewalActive', '0');
    $this->main->router->redirectTo('cloud');
  }

}