<?php

namespace Master\Core\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admins extends Authenticatable 
{
	use Notifiable;

  protected $table = 'admins';

  protected $fillable = [
    'name', 'email', 'password', 'status'
  ];


  protected $hidden = [
    'password', 'remember_token',
  ];
}
