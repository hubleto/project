<?php

namespace HubletoApp\Community\Cloud\Controllers;

class ActivateSubscriptionRenewal extends \HubletoMain\Core\Controllers\Controller {

  public function prepareView(): void
  {
    parent::prepareView();

    $this->hubletoApp->saveConfig('subscriptionRenewalActive', '1');
    $this->hubletoApp->saveConfig('subscriptionActiveUntil', date('Y-m-d H:i:s', strtotime('+1 month')));

    $currentCredit = $this->hubletoApp->recalculateCredit();

    $mPayment = new \HubletoApp\Community\Cloud\Models\Payment($this->main);
    $mPayment->record->recordCreate([
      'datetime_charged' => date('Y-m-d H:i:s'),
      'full_amount' => -$currentCredit,
      'type' => $mPayment::TYPE_SUBSCRIPTION_RENEWAL_ACTIVATED,
    ]);

    $this->main->router->redirectTo('cloud');
  }

}