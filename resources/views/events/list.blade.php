@extends('layouts.app')

@section('content')

<h1 id="title">Upcomming Events</h1>
<ais-instant-search
    :search-client="searchClient"
    index-name="{{ (new App\Event)->searchableAs() }}"

>
    <ais-search-box placeholder="Search events..."></ais-search-box>

    <div class="search-container">
    <div class="filters">
        <ais-refinement-list
            attribute="tags.name"
            searchable
            searchable-placeholder="Search available tags"
            show-more>
        </ais-refinement-list>
    </div>

    <div class="results">
        <ais-hits />
            <template slot="item" slot-scope="{ item }">
                <div class="event">
                    <div class="event-image" style="background-image: url('https://picsum.photos/200')"></div>
                    <div class="event-info">
                        <a :href="`/events/${item.id}`"><span class="event-name">@{{ item.name}}</span></a>
                    </div>
                </div>
            </template>
        </ais-hits>
    </div>
</div>
    <ais-Pagination></ais-Pagination>
</ais-instant-search>

@endsection

@section('styles')
<link href="{{ asset('css/event/list.css') }}" rel="stylesheet">
@endsection
