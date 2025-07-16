<?php

namespace HubletoApp\Community\OAuth\Models;

use \ADIOS\Core\Db\Column\Varchar;

class Scope extends \HubletoMain\Core\Models\Model
{

  public string $table = 'oauth_scopes';
  public string $recordManagerClass = RecordManagers\Scope::class;
  public ?string $lookupSqlValue = 'concat("Scope #", {%TABLE%}.id)';

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'scope_id' => (new Varchar($this, $this->translate('Scope Id')))->setProperty('defaultVisibility', true),
      'description' => (new Varchar($this, $this->translate('Description')))->setProperty('defaultVisibility', true),
    ]);
  }

  public function describeTable(): \ADIOS\Core\Description\Table
  {
    $description = parent::describeTable();
    $description->ui['addButtonText'] = 'Add Scope';
    $description->ui['showHeader'] = true;
    $description->ui['showFulltextSearch'] = true;
    $description->ui['showFooter'] = false;
    return $description;
  }

}
