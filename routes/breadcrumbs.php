<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
   $trail->push('Dashboard', route('admin.dashboard'));
});