<?php

namespace HubletoApp\Community\Settings\Models;

use ADIOS\Core\Db\Column\Varchar;

class Permission extends \HubletoMain\Core\Models\Model
{
  public string $table = 'permissions';
  public string $recordManagerClass = RecordManagers\Permission::class;
  public ?string $lookupSqlValue = '{%TABLE%}.permission';

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'permission' => (new Varchar($this, $this->translate('Permission'))),
    ]);
  }

  public function describeTable(): \ADIOS\Core\Description\Table
  {
    $description = parent::describeTable();

    $description->ui['title'] = 'Permissions';
    $description->ui['showHeader'] = true;
    $description->ui['showFulltextSearch'] = true;
    $description->ui['showFooter'] = false;

    // $description->permissions['canCreate'] = false;
    // $description->permissions['canUpdate'] = false;
    // $description->permissions['canDelete'] = false;

    return $description;
  }

  public function describeForm(): \ADIOS\Core\Description\Form
  {
    $description = parent::describeForm();

    $description->ui['title'] = 'Permission';

    return $description;
  }
}
