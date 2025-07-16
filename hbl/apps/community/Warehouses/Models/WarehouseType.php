<?php

namespace HubletoApp\Community\Warehouses\Models;

use \ADIOS\Core\Db\Column\Varchar;

class WarehouseType extends \HubletoMain\Core\Models\Model
{

  public string $table = 'warehouses_types';
  public string $recordManagerClass = RecordManagers\WarehouseType::class;
  public ?string $lookupSqlValue = '{%TABLE%}.name';

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'name' => (new Varchar($this, $this->translate('Name')))->setProperty('defaultVisibility', true),
    ]);
  }

}
