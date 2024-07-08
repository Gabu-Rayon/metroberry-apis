<div class="sidebar-body">
    @include('components.sidebar.sidebar-nav')
    <div class="mt-auto p-3 sidebar-logout">
        <form method="POST" action="..//logout" class="d-inline">
            <input type="hidden" name="_token" value="AQNLvAb467g0eZtkGATqrKcNNVohCNfvLiX4IjQc" autocomplete="off">
            <button type="submit" id="logout-btn">
                <span class="btn btn-dark w-100"> <img class="me-2"
                    src="..//admin-assets/img/logout.png?v=1"><span>Logout</span></span>
                </button>
            </form>
            <link href="..//admin-assets/css/logout.css?v=1" rel="stylesheet">
        </div>
    </div>