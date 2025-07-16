<?php

namespace HubletoApp\Community\Customers\Models\RecordManagers;

use HubletoApp\Community\Settings\Models\RecordManagers\User;
use \Illuminate\Database\Eloquent\Relations\HasMany;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tag extends \HubletoMain\Core\RecordManager
{
  public $table = 'customer_tags';
}
