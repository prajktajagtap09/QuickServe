<header class="header">
<nav class="navbar navbar-expand-lg">

<div class="container-fluid d-flex align-items-center justify-content-between">

<!-- Logo -->
<div class="navbar-header">
<a href="#" class="navbar-brand">
<div class="brand-text brand-big text-uppercase">
<strong class="text-primary">Dark</strong><strong>Admin</strong>
</div>
</a>

<!-- Sidebar Toggle -->
<button class="sidebar-toggle">
<i class="fa fa-long-arrow-left"></i>
</button>
</div>

<!-- Right Side Menu -->
<div class="right-menu list-inline no-margin-bottom">

<!-- Logout -->
<div class="list-inline-item logout">

<form method="POST" action="{{ route('logout') }}">
@csrf
<input class="btn btn-primary" type="submit" value="Logout">
</form>

</div>

</div>

</div>

</nav>
</header>