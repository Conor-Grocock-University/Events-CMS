<nav>
        <a class="brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>

        <div class="central">
            <div class="nav-item">
                <a href="{{ route('events.index') }}">All events</a>
            </div>
            @auth
                <div class="nav-item">
                    <a href="{{ route('events.interests') }}">My events</a>
                </div>
            @endauth
        </div>

        <div class="user">
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <span onclick="toggleDropdown('dropdown')">{{ Auth::user()->name }}</span>
                <div id="dropdown" class="hidden">
                    <a href="{{ route('events.create') }}">
                        Create new event
                    </a>
                    <a href="{{ route('users.edit', ["user"=> Auth::user()]) }}">
                        Edit Profile
                    </a>
                    <a href="{{ route('events.interests') }}">
                            Upcomming events
                        </a>
                    <hr class="divider">
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>
    </nav>
