<?php

namespace Tests\Feature;

use App\Models\Affiliate;
use App\Models\AffiliateProgram;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class AffiliateSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_welcome_page_displays_affiliate_system_info(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('welcome')
        );
    }

    public function test_authenticated_user_can_access_affiliate_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/affiliate');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('affiliate/register')
        );
    }

    public function test_user_can_register_as_affiliate(): void
    {
        $user = User::factory()->create();

        $affiliateData = [
            'full_name' => 'John Doe',
            'phone' => '081234567890',
            'bank_name' => 'BCA (Bank Central Asia)',
            'bank_account_number' => '1234567890',
            'bank_account_holder' => 'John Doe',
        ];

        $response = $this->actingAs($user)->post('/affiliate', $affiliateData);

        $response->assertRedirect('/affiliate');
        $this->assertDatabaseHas('affiliates', [
            'user_id' => $user->id,
            'full_name' => 'John Doe',
            'phone' => '081234567890',
            'status' => 'pending',
        ]);
    }

    public function test_affiliate_dashboard_shows_stats_for_approved_affiliate(): void
    {
        $user = User::factory()->create();
        $affiliate = Affiliate::factory()->active()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get('/affiliate');

        $response->assertStatus(200);
        $response->assertInertia(fn (Assert $page) => $page
            ->component('affiliate/dashboard')
            ->has('affiliate')
            ->where('affiliate.full_name', $affiliate->full_name)
        );
    }

    public function test_database_seeder_creates_affiliate_programs(): void
    {
        $this->artisan('db:seed', ['--class' => 'AffiliateProgramSeeder']);

        $this->assertTrue(AffiliateProgram::count() >= 28); // At least 28 programs
        
        // Check for specific programs
        $this->assertDatabaseHas('affiliate_programs', [
            'name' => 'Kids English Online',
            'type' => 'online',
            'category' => 'Kids',
        ]);
        
        $this->assertDatabaseHas('affiliate_programs', [
            'name' => 'English Program 3 Months',
            'type' => 'offline',
            'location' => 'Kediri',
        ]);
    }

    public function test_affiliate_registration_requires_all_fields(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/affiliate', []);

        $response->assertSessionHasErrors([
            'full_name',
            'phone',
            'bank_name',
            'bank_account_number',
            'bank_account_holder',
        ]);
    }

    public function test_guest_cannot_access_affiliate_dashboard(): void
    {
        $response = $this->get('/affiliate');

        $response->assertRedirect('/login');
    }

    public function test_affiliate_programs_exist_in_database(): void
    {
        AffiliateProgram::factory()->count(5)->create();

        $this->assertDatabaseCount('affiliate_programs', 5);
        
        $program = AffiliateProgram::first();
        $this->assertNotNull($program->name);
        $this->assertNotNull($program->type);
        $this->assertNotNull($program->base_price);
        $this->assertNotNull($program->commission_rate);
    }
}