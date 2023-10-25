<?php

namespace Tests\Unit\Traits\ResourceCheck;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Traits\ResourceCheck\AccessCheck;
use App\Models\User;
use App\Models\Website;

class AccessCheckTest extends TestCase
{
    use AccessCheck;
    use RefreshDatabase;

    /**
     * Test if user has access rights to a website
     *
     * @return void
     */
    public function testCheckUserWebsiteAccess()
    {
        $user_1 = User::factory()->create();
        $user_2 = User::factory()->create();
        $website_1 = Website::factory()->create([
            'user_id' => $user_1->id    
        ]);

        $hasAccess = $this->checkAccess($user_1, $website_1);
        $this->assertTrue($hasAccess);

        $hasAccess = $this->checkAccess($user_2, $website_1);
        $this->assertFalse($hasAccess);
    }
}
