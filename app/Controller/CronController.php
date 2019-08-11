<?php

namespace App\Controller;

use \Core\Controller;
use App\Model\Cron;

class CronController extends Controller
{
    public function getList()
    {
        $cron = new Cron;
        $list = $cron->getLocalList();

        $items = array_map(function ($key, $item) {
            return [
                'jobId' => $key,
                'job' => $item,
                'author' => 'System',
                'createAt' => date('Y-m-d H:i', $_SERVER['REQUEST_TIME']),
                'status' => 'success'
            ];
        }, array_keys($list), $list);

        return $this->response(['list' => $items, 'total' => count($items)]);
    }

    public function addCron()
    {
        return $this->response([]);
    }

    public function editCron()
    {
        return $this->response([]);
    }

    public function getCron()
    {
        return $this->response([]);
    }

    public function deleteCron()
    {
        return $this->response([]);
    }
}
