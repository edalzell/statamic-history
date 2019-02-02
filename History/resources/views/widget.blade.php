<div class="card flush">
    <div class="head">
        <h1>{{ $title }}</h1>
    </div>
    <div class="card-body pad-16">
        <table class="dossier">
            <thead>
                <tr>
                    <th>Content</th>
                    <th>User</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>
                        <a href="{{ $event->content->editUrl() }}">{{ $event->content->get('title') }}</a>
                    </td>
                    <td>
                        {{ $event->user->get('first_name') . ' ' . $event->user->get('last_name') }}
                    </td>
                    <td>
                        {{ $event->last_modified->format($format) }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
