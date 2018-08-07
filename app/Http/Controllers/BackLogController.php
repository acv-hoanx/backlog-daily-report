<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Itigoppo\BacklogApi\Backlog\Backlog;
use Itigoppo\BacklogApi\Connector\ApiKeyConnector;

class BackLogController extends Controller
{
    protected $backLogObj;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * GET
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function activity()
    {
        $projectList = $this->_getActivityLog();

        return view('activity', compact('projectList'));
    }

    public function report()
    {
        $projectList = $this->_getActivityLog();
        $content     = view('report-template-submit', compact('projectList'))->render();

        $projectReportId = 35916; // DAYLYREPORT
        $summary         = 'Report: ' . Carbon::today()->format('d/m/Y');
        $issueTypeId     = 162484;
        $priorityId      = 3;
        $this->backLogObj->issues->create($projectReportId, $summary, $issueTypeId, $priorityId, [
            'description' => $content,
            'assigneeId'  => 71558,
        ]);

        return redirect('https://acdev.backlog.com/projects/DAILYREPORT');
    }

    public function activity_done()
    {
        $spaceID     = 'acdev';
        $apiKey      = 'EjAMsmK3hJfl0GY1uH6xVxjYxmJtQQhBF38a5JdlNcJnwcDr9cbzfSgQerQSVJnx';
        $user_id     = 72006;
        $projectList = $projectKey = $contentIDs = [];
        $dateReport  = Carbon::today()->format('d/m/Y');

        $backlog = new Backlog(new ApiKeyConnector($spaceID, $apiKey));

        $userBL = $backlog->users->myself();

        $users = [
            'name' => $userBL->name,
            'team' => 'Server',
            'date' => $dateReport
        ];

        $activityList = $backlog->users->activities($user_id, [
            'count' => 100,
        ]);
        if ($activityList) {
            foreach ($activityList as $activity) {
                $inDay = Carbon::parse($activity->created)->diffInDays(Carbon::today());
                if ($inDay == 0 && isset($activity->content->changes) && ! in_array($activity->content->id,
                        $contentIDs)) {
                    $contentIDs[] = $activity->content->id;
                    if ( ! in_array($activity->project->projectKey, $projectKey)) {
                        $projectKey[] = $activity->project->projectKey;
                        $pi           = 0;
                    } else {
                        $pi++;
                    }

                    foreach ($activity->content->changes as $change) {
                        if ($change->field == 'actualHours') {
                            $projectList[$activity->project->name][$pi]['task']        = $activity->content->summary;
                            $projectList[$activity->project->name][$pi]['actualHours'] = $change->new_value;
                        }
                    }


                } else {
                    continue;
                }
            }
        }

        $view = view('report-template', compact('projectList', 'users'))->render();

//        $projectReportId = 35916; // DAYLYREPORT
//        $summary = 'Report: ' . $dateReport;
//        $issueTypeId = 162484;
//        $priorityId = 3;
//        $backlog->issues->create($projectReportId, $summary, $issueTypeId, $priorityId, [
//            'description' => $view,
//            'assigneeId' => 71558,
//        ]);

        return $view;
    }

    private function _getActivityLog()
    {
        $backLogURL  = 'https://acdev.backlog.com/';
        $apiKey      = Auth::user()->backlog_api_key;
        $spaceID     = 'acdev';
        $projectList = $projectKey = $contentIDs = [];

        if ($this->backLogObj) {
            $backlog = $this->backLogObj;
        } else {
            $backlog = new Backlog(new ApiKeyConnector($spaceID, $apiKey));
            $this->setBackLogObj($backlog);
        }

        $userBL     = $backlog->users->myself();
        $backLogUID = $userBL->id;

        $activityList = $backlog->users->activities($backLogUID, [
            'count' => 100,
        ]);
        if ($activityList) {
            foreach ($activityList as $activity) {
                $created = Carbon::parse($activity->created)->format('Y-m-d');
                $inDay = Carbon::today()->diffInDays($created);


                if ($inDay == 0 && isset($activity->content->id)
                    && isset($activity->content->changes)
                    && ! in_array($activity->content->id, $contentIDs)) {

                    $contentIDs[] = $activity->content->id;

                    if ( ! in_array($activity->project->projectKey, $projectKey)) {
                        $projectKey[] = $activity->project->projectKey;
                        $pi           = 0;
                    } else {
                        $pi++;
                    }

                    foreach ($activity->content->changes as $change) {
                        if ($change->field == 'actualHours') {

                            if ((float)$change->new_value > (float)$change->old_value) {
                                $actualHours = (float)$change->new_value - (float)$change->old_value;
                            } else {
                                $actualHours = (float)$change->new_value;
                            }

                            $projectList[$activity->project->name][$pi]['task']        = $activity->content->summary;
                            $projectList[$activity->project->name][$pi]['url_task']    = $backLogURL.'view/'.$activity->project->projectKey.'-'.$activity->content->key_id;
                            $projectList[$activity->project->name][$pi]['url_title']    = $activity->project->projectKey.'-'.$activity->content->key_id;
                            $projectList[$activity->project->name][$pi]['actualHours'] = $actualHours;
                        }
                    }


                } else {
                    continue;
                }
            }
        }

        return $projectList;
    }

    /**
     * @param mixed $backLogObj
     */
    public function setBackLogObj($backLogObj): void
    {
        $this->backLogObj = $backLogObj;
    }


}
