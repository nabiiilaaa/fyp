<div class="left-sidebar bg-dark">
	<img src="/ReadersZone/wwwroot/images/logo.png" style="width: 100%; padding: 0px 10px 0px 10px;"/>
	<ul class="nav flex-column collapsible mt-4">
		<!--- Dashboard--->
		<li class="nav-item">
			<a href="dashboard.php" class="nav-link">
			<i class="fa fa-home"></i> Dashboard
			</a>
		</li>
		<!--- Website content--->
		<li class="nav-item toggle">
			<a class="nav-link" href="#"><i class="fa fa-laptop"></i>  Management</a>
			<ul class="nav flex-column toggle-list">
				<li class="nav-item">
					<a href="dashboard.php?page=category-list" class="nav-link">
					<i class="fa fa-list"></i> Categories
					</a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=author-list" class="nav-link">
					<i class="fa fa-list"></i> Authors
					</a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=publisher-list" class="nav-link">
					<i class="fa fa-list"></i> Publishers
					</a>
				</li>
				<li class="nav-item">
					<a href="dashboard.php?page=book-list" class="nav-link">
					<i class="fa fa-list"></i> Books
					</a>
				</li>
			</ul>
		</li>
	</ul>
	<ul class="nav flex-column collapsible mt-4" style="position: absolute; bottom: 10px;">
		<li class="nav-item">
			<a class="nav-link" href="scripts/AdminLogout.php"><i class="fa fa-users"></i> Logout</a>
		</li>
	</ul>
</div>