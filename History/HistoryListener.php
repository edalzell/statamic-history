<?php

namespace Statamic\Addons\History;

use Statamic\API\Nav;
use Statamic\API\User;
use Statamic\Extend\Listener;
use Statamic\Contracts\Data\DataEvent;
use Statamic\Addons\History\Models\Event;

class HistoryListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.nav.created' => 'nav',
        \Statamic\Events\Data\EntrySaved::class => 'record',
        \Statamic\Events\Data\GlobalsSaved::class => 'record',
        \Statamic\Events\Data\PageSaved::class => 'record',
        \Statamic\Events\Data\PagesMoved::class => 'record',
    ];

    public function record(DataEvent $event)
    {
        $record = Event::create(
            [
                'user' => User::getCurrent(),
                'action' => $event,
                'content' => $event->data,
            ]
        );
    }

    /**
     * Add History to the side nav
     * @param  Nav    $nav [description]
     * @return void
     */
    public function nav($nav)
    {
        // Only super users can see the PHP info
        /** @var \Statamic\Data\Users\User $user */
        $user = User::getCurrent();
        if ($user && $user->isSuper()) {
            $nav->addTo(
                'tools',
                Nav::item('History')->route('all')->icon('back-in-time')
            );
        }
    }
}
