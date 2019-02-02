<?php

namespace Statamic\Addons\History;

use Statamic\API\Config;
use Statamic\Extend\Controller;
use Statamic\Addons\History\Models\Event;

class HistoryController extends Controller
{
    /**
     * Maps to your route definition in routes.yaml
     *
     * @return mixed
     */
    public function history()
    {
        $format = $this->getConfig('date_format', Config::get('cp.date_format'));

        // limiting to 100 until I implement https://github.com/edalzell/statamic-history/issues/1
        $events = Event::orderBy('created_at', 'desc')
            ->limit(100)
            ->get();

        return $this->view('history', compact('events', 'format'));
    }
}
