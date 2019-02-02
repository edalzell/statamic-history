<?php

namespace Statamic\Addons\History\Widgets;

use Statamic\API\User;
use Statamic\API\Config;
use Statamic\Extend\Widget;

class HistoryWidget extends Widget
{
    /**
     * The HTML that should be shown in the widget
     *
     * @return string
     */
    public function html()
    {
        $title = $this->get('title', 'Recent History');

        $format = $this->get('date_format', Config::get('cp.date_format'));

        $events = $this->history();

        return $this->view('widget', compact('title', 'events', 'format'));
    }

    public function history()
    {
        // sort by newest changes
        $events = Event::orderBy('created_at', 'desc');

        if ($this->get('current_user', false)) {
            $events = $events->whereUser(User::getCurrent());
        }

        $events = $events->get();

        if (!$this->get('all_events', true)) {
            $events = $events->unique(function ($event) {
                return $events->content_id;
            });
        }

        return $events->slice(0, $this->getInt('limit', 5));
    }
}
