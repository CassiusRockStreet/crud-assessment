<div class="row">
        <div class="col-md-12">
        @guest
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="/">CRUD application</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </nav>
        @endguest
        @auth
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="/dashboard">Dashboard</a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    @if(Auth::user()->userrole->is_admin != "on")
                    <div class="navbar-nav">
                        <a class="nav-link" href="#">Create new post</a>
                        <a class="nav-link" href="/view-profile/">My Profile</a>
                        <a class="nav-link" href="/logout">Logout</a>
                    </div>
                    @else
                    <div class="navbar-nav">
                        <a class="nav-link" href="/users">Users</a>
                        <a class="nav-link" href="/manage-roles">Manage roles</a>
                        <a class="nav-link" href="/logout">Logout</a>
                    </div>
                    @endif
                </div>
            </div>
            </nav>
        @endauth
        </div>
</div>