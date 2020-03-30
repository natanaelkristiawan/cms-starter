<?php

Breadcrumbs::for('articles', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Articles', route('admin.articles'));
});

Breadcrumbs::for('articles.create', function ($trail) {
  $trail->parent('articles');
  $trail->push('Create', route('admin.articles.create'));
});

Breadcrumbs::for('articles.edit', function ($trail) {
  $trail->parent('articles');
  $trail->push('Create', route('admin.articles.create'));
});

Breadcrumbs::for('categories', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Categories', route('admin.categories'));
});

Breadcrumbs::for('categories.create', function ($trail) {
  $trail->parent('categories');
  $trail->push('Create', route('admin.categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail) {
  $trail->parent('categories');
  $trail->push('Create', route('admin.categories.create'));
});