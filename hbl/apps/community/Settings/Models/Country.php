<?php

namespace HubletoApp\Community\Settings\Models;

use ADIOS\Core\Db\Column\Varchar;

class Country extends \HubletoMain\Core\Models\Model
{
  public string $table = 'countries';
  public string $recordManagerClass = RecordManagers\Country::class;
  public ?string $lookupSqlValue = '{%TABLE%}.name';

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'name' => (new Varchar($this, $this->translate('Country'))),
      'code' => (new Varchar($this, $this->translate('Code'))),
    ]);
  }

  public function describeTable(): \ADIOS\Core\Description\Table
  {
    $description = parent::describeTable();

    $description->ui['title'] = 'Countries';
    $description->ui['addButtonText'] = 'Add Country';
    $description->ui['showHeader'] = true;
    $description->ui['showFulltextSearch'] = true;
    $description->ui['showFooter'] = false;

    return $description;
  }

}
