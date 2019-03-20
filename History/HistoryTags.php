<?php

namespace Statamic\Addons\History;

use Statamic\Extend\Tags;
use Statamic\Addons\History\Models\Event;

class HistoryTags extends Tags
{
    /**
     * The {{ history }} tag
     *
     * @return string|array
     */
    public function index()
    {
        $events = Event::findbyContentId($this->get('id'));

        $events = $events->map(function ($event, $key) {
            return $event->toArray();
        })->values()->all();

        return $this->parseLoop($events);
    }
}
