<?php

namespace App\Traits\ResourceCheck\AccessCheck;

use App\Models\User;
use App\Models\Website;
use App\Models\WebsitePage;

/**
 * Trait UserAccessCheck
 * 
 * Checks if the user model has access to the
 * given resource.
 */
trait UserAccessCheck {

  /**
   * Checks the model of the resource, then
   * executes the corrent function to check
   * access rights.
   * 
   * @param User $owner
   * @param mixed $resource
   * 
   * @return boolean|null
   */
  public function checkUserAccess(User $owner, $resource)
  {
    if ($resource instanceof Website) {
      return $this->checkUserAccessToWebsite($owner, $resource);
    }else if ($resource instanceof WebsitePage) {
      return $this->checkUserAccessToWebsitePage($owner, $resource);
    }else {
      return null;
    }
  }

  /**
   * By default the User model has it's ID
   * column hidden. This function exposes the
   * user's ID.
   * 
   * @param User $user
   * 
   * @return User
   */
  private function getUserID(User $user)
  {
    return $user->setHidden(['password', 'remember_token'])->setVisible(['id'])->id;
  }

  /**
   * Checks if user has access to website
   * 
   * @param User $owner
   * @param Website $resource
   * 
   * @return boolean
   */
  private function checkUserAccessToWebsite(User $owner, Website $resource)
  {
    return $this->getUserID($owner) === $this->getUserID($resource->user);
  }

  /**
   * Checks if user has access to website page
   * 
   * @param User $owner
   * @param WebsitePage $resource
   * 
   * @return boolean
   */
  private function checkUserAccessToWebsitePage(User $owner, WebsitePage $resource)
  {
    return $this->getUserID($owner) === $this->getUserID($resource->website->user);
  }
}
