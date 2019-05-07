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

    /**
     * The {{ history:latest }} tag
     * Returns the latest record.
     *
     * @return string
     */
    public function latest()
    {
        $events = Event::findbyContentId($this->get('id'));

        $event = $events->map(function ($event, $key) {
            return $event->toArray();
        })->values()->last();

        return $this->parse($event);
    }

    /**
     * The {{ history:earliest }} tag
     * Returns the earliest record.
     *
     * @return string
     */
    public function earliest()
    {
        $events = Event::findbyContentId($this->get('id'));

        $event = $events->map(function ($event, $key) {
            return $event->toArray();
        })->values()->first();

        return $this->parse($event);
    }
}
