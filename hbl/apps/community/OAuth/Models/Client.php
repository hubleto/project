<?php

namespace HubletoApp\Community\OAuth\Models;

use \ADIOS\Core\Db\Column\Varchar;
use \ADIOS\Core\Db\Column\VarcBooleanhar;

class Client extends \HubletoMain\Core\Models\Model
{

  public string $table = 'oauth_clients';
  public string $recordManagerClass = RecordManagers\Client::class;
  public ?string $lookupSqlValue = 'concat("Client #", {%TABLE%}.id)';

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'client_id' => (new Varchar($this, $this->translate('Client Id')))->setProperty('defaultVisibility', true),
      'client_secret' => (new Varchar($this, $this->translate('Client Secret')))->setProperty('defaultVisibility', true),
      'name' => (new Varchar($this, $this->translate('Name')))->setProperty('defaultVisibility', true),
      'redirect_uri' => (new Varchar($this, $this->translate('Redirect Uri')))->setProperty('defaultVisibility', true),
    ]);
  }

  public function describeTable(): \ADIOS\Core\Description\Table
  {
    $description = parent::describeTable();
    $description->ui['addButtonText'] = 'Add Client';
    $description->ui['showHeader'] = true;
    $description->ui['showFulltextSearch'] = true;
    $description->ui['showFooter'] = false;
    return $description;
  }

}
