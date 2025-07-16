<?php

namespace HubletoApp\Community\Usage\Models;

use ADIOS\Core\Db\Column\DateTime;
use ADIOS\Core\Db\Column\Lookup;
use ADIOS\Core\Db\Column\Varchar;

use HubletoApp\Community\Settings\Models\User;

class Log extends \HubletoMain\Core\Models\Model
{
  public string $table = 'usage_log';
  public string $recordManagerClass = RecordManagers\Log::class;

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'datetime' => (new DateTime($this, $this->translate('Time')))->setRequired(),
      'ip' => (new Varchar($this, $this->translate('IP')))->setRequired(),
      'route' => (new Varchar($this, $this->translate('Route')))->setRequired(),
      'params' => (new Varchar($this, $this->translate('Params'))),
      'message' => (new Varchar($this, $this->translate('Message'))),
      'id_user' => (new Lookup($this, $this->translate('User'), User::class))->setRequired(),
    ]);
  }

  public function describeTable(): \ADIOS\Core\Description\Table
  {
    $description = parent::describeTable();
    $description->columns['id'] = $this->columns['id'];
    $description->permissions['canCreate'] = false;
    $description->permissions['canUpdate'] = false;
    $description->permissions['canDelete'] = false;
    $description->ui['showFulltextSearch'] = true;
    $description->ui['showColumnSearch'] = true;
    return $description;
  }

}
