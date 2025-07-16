<?php

namespace HubletoApp\Community\Pipeline\Models;

use ADIOS\Core\Db\Column\Color;
use ADIOS\Core\Db\Column\Integer;
use ADIOS\Core\Db\Column\Lookup;
use ADIOS\Core\Db\Column\Varchar;
use HubletoApp\Community\Deals\Models\Deal;

class PipelineStep extends \HubletoMain\Core\Models\Model
{
  public string $table = 'pipeline_steps';
  public string $recordManagerClass = RecordManagers\PipelineStep::class;
  public ?string $lookupSqlValue = '{%TABLE%}.name';

  public array $relations = [
    'PIPELINE' => [ self::BELONGS_TO, Pipeline::class, 'id_pipeline', 'id' ]
  ];

  public function describeColumns(): array
  {
    return array_merge(parent::describeColumns(), [
      'name' => (new Varchar($this, $this->translate('Name')))->setRequired(),
      'order' => (new Integer($this, $this->translate('Order')))->setRequired(),
      'color' => (new Color($this, $this->translate('Color')))->setRequired(),
      'probability' => (new Integer($this, $this->translate('Probability')))->setUnit("%"),
      'id_pipeline' => (new Lookup($this, $this->translate("Pipeline"), Pipeline::class))->setRequired(),
      'set_result' => (new Integer($this, $this->translate('Set result of a deal to')))
        ->setEnumValues([Deal::RESULT_UNKNOWN => "Unknown", Deal::RESULT_WON => "Won",  Deal::RESULT_LOST => "Lost"])
    ]);
  }

  public function describeTable(): \ADIOS\Core\Description\Table
  {
    $description = parent::describeTable();

    $description->ui['title'] = 'Pipeline Steps';
    $description->ui['addButtonText'] = 'Add Pipeline Step';
    $description->ui['showHeader'] = true;
    $description->ui['showFulltextSearch'] = true;
    $description->ui['showFooter'] = false;

    return $description;
  }
}
