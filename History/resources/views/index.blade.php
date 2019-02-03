@extends('layout')

@section('content')
<div id="history">
    <div class="flexy mb-3">
        <h1 class="fill">History</h1>
    </div>

    <div class="card flush dossier-for-mobile">
        <div class="dossier-table-wrapper">
            <table class="dossier">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>User</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
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
</div>
@endsection
