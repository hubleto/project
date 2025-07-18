<?php

namespace HubletoApp\Community\Calendar;

use HubletoApp\Community\Calendar\Models\Activity;
use HubletoApp\Community\Calendar\Models\SharedCalendar;

class Loader extends \HubletoMain\Core\App
{

  public CalendarManager $calendarManager;

   public bool $hasCustomSettings = true;

  public function __construct(\HubletoMain $main)
  {
    parent::__construct($main);
    $this->calendarManager = new CalendarManager($main);
  }

  public function init(): void
  {
    parent::init();

    $this->main->router->httpGet([
      '/^calendar\/?$/' => Controllers\Calendar::class,
      '/^calendar(\/(?<key>\w+))?\/ics\/?$/' => Controllers\IcsCalendar::class,
      '/^calendar\/settings\/?$/' => Controllers\Settings::class,
      '/^calendar\/boards\/reminders\/?$/' => Controllers\Boards\Reminders::class,
      '/^calendar\/api\/get-calendar-events\/?$/' => Controllers\Api\GetCalendarEvents::class,
      '/^calendar\/api\/get-shared-calendars\/?$/' => Controllers\Api\GetSharedCalendars::class,
      '/^calendar\/api\/stop-sharing-calendar\/?$/' => Controllers\Api\StopSharingCalendar::class,
    ]);

    $this->main->apps->community('Help')?->addContextHelpUrls('/^calendar\/?$/', [
      'en' => 'en/apps/community/calendar',
    ]);

    $this->main->apps->community('Dashboards')?->addBoard(
      $this,
      $this->translate('Reminders'),
      'calendar/boards/reminders'
    );

    $this->main->apps->community('Calendar')?->calendarManager?->addCalendar(
      'calendar',
      'blue',
      Calendar::class
    );

  }

  public function installTables(int $round): void
  {
    if ($round == 1) {
      $mActivity = new Activity($this->main);
      $mActivity->install();
      $mSharedCalendar = new SharedCalendar($this->main);
      $mSharedCalendar->install();
    }
  }

  public function loadRemindersSummary(int $idUser = 0): array
  {
    $getCalendarEvents = new \HubletoApp\Community\Calendar\Controllers\Api\GetCalendarEvents($this->main);

    $remindersToday = $getCalendarEvents->loadEventsFromMultipleCalendars(
      date("Y-m-d", strtotime("-1 year")),
      date("Y-m-d"),
      ['completed' => false, 'idUser' => $idUser]
    );
 
    $dateTomorrow = date("Y-m-d", time() + 24*3600);
    $remindersTomorrow = $getCalendarEvents->loadEventsFromMultipleCalendars(
      $dateTomorrow,
      $dateTomorrow,
      ['completed' => false, 'idUser' => $idUser]
    );

    $dateLaterStart = date("Y-m-d", time() + 24*3600 * 2);
    $dateLaterEnd = date("Y-m-d", time() + 24*3600 * 7);
    $remindersLater = $getCalendarEvents->loadEventsFromMultipleCalendars(
      $dateLaterStart,
      $dateLaterEnd,
      ['completed' => false, 'idUser' => $idUser]
    );

    return [$remindersToday, $remindersTomorrow, $remindersLater];
  }

  // public function installDefaultPermissions(): void
  // {
  //   $mPermission = new \HubletoApp\Community\Settings\Models\Permission($this->main);
  //   $permissions = [
  //     "HubletoApp/Community/Calendar/Calendar",
  //     "HubletoApp/Community/Calendar/Controllers/Calendar",
  //     "HubletoApp/Community/Calendar/Api/GetCalendarEvents",
  //   ];

  //   foreach ($permissions as $permission) {
  //     $mPermission->record->recordCreate([
  //       "permission" => $permission
  //     ]);
  //   }
  // }

}