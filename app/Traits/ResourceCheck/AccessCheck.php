<?php

namespace App\Traits\ResourceCheck;

use App\Models\User;
use App\Traits\ResourceCheck\AccessCheck\UserAccessCheck;

/**
 * Trait AccessCheck
 * 
 * Checks whether the owner (ex. user) has access
 * on the given resource (ex. post)
 */
trait AccessCheck {
  use UserAccessCheck;

  /**
   * Checks if the model of the owner and then 
   * executes the function to check the resource.
   * Returns null if model is not in the list.
   * 
   * @param mixed $owner
   * @param mixed $resource
   * 
   * @return boolean|null
   */
  public function checkAccess($owner, $resource)
  {
    if ($owner instanceof User) {
      return $this->checkUserAccess($owner, $resource);
    }else{
      return null;
    }
  }
}
