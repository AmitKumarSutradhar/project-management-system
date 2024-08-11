<header>
    <nav class="navbar navbar-expand-lg bg-dark-subtle">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Navbar</a>
            <div class="collapse navbar-collapse justify-content-end" id="navbarTogglerDemo03">
                <ul class="navbar-nav mb-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    @if(auth()->user()->isAdmin() || auth()->user()->isProjectManager())
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('project.index') }}">Project</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="#"> My Task</a>
                    </li>


                    @if(auth()->user()->isProjectManager())
                        <a href="#">Ami Project Manager</a>
                    @endif
                    @if(auth()->user()->isTeamMember())
                        <a href="#">Ami Team Member</a>
                    @endif
                    @if(auth()->user()->isUser())
                        <a href="#">Ami User</a>
                    @endif
                </ul>
                <form class="d-flex" role="search">
                    <button class="btn btn-outline-success" type="submit">Avatar</button>
                </form>
            </div>
        </div>
    </nav>
</header>
