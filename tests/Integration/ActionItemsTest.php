<?php

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use SET\Training;
use SET\User;
use SET\Visit;

/**
 * Class ActionItemsTest.
 *
 * Runs tests against app/Http/ViewComposers/ActionItemsComposer.php file.
 * This is displayed on the left column for admin users.
 */
class ActionItemsTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp()
    {
        parent::setUp();

        $this->signIn();
    }

    /** @test */
    public function it_lists_past_due_training()
    {
        $userOne = factory(User::class)->create();
        $userTwo = factory(User::class)->create();
        $training = factory(Training::class)->create();
        $training->users()->attach($userOne, ['due_date' => Carbon::yesterday(), 'author_id' => $this->user->id]);
        $training->users()->attach($userTwo, ['due_date' => Carbon::tomorrow(), 'author_id' => $this->user->id]);

        $this->visit('duty') //visit some page that won't have the user nor the training.
            ->see($training->name)
            ->see($userOne->userFullName)
            ->dontSee($userTwo->userFullName);
    }

    /** @test */
    public function it_lists_expiring_visitation_rights()
    {
        $visitOne = factory(Visit::class)->create(['expiration_date' => Carbon::tomorrow()]);
        $visitTwo = factory(Visit::class)->create(['expiration_date' => Carbon::today()->subWeek()]);

        $this->visit('duty')
            ->see($visitOne->smo_code)
            ->dontSee($visitTwo->smo_code);
    }

    /** @test */
    public function it_lists_users_whose_clearance_is_about_to_expire()
    {
        $topSecretUser = factory(User::class)->create([
            'clearance' => 'TS',
            'elig_date' => Carbon::today()->subYears(2)->format('Y-m-d'),
        ]);
        $secretUser = factory(User::class)->create([
            'clearance' => 'S',
            'elig_date' => Carbon::today()->subYears(8)->format('Y-m-d'),
        ]);
        $expiringTopSecretUser = factory(User::class)->create([
            'clearance' => 'TS',
            'elig_date' => Carbon::today()->subYears(5)->format('Y-m-d'),
        ]);
        $expiringSecretUser = factory(User::class)->create([
            'clearance' => 'S',
            'elig_date' => Carbon::today()->subYears(10)->format('Y-m-d'),
        ]);
        $secretAccessLevelUser = factory(User::class)->create([
            'clearance'    => 'TS',
            'access_level' => 'S',
            'elig_date'    => Carbon::today()->subYears(6)->format('Y-m-d'),
        ]);

        $this->visit('duty')
            ->see($expiringSecretUser->userFullName)
            ->see($expiringTopSecretUser->userFullName)
            ->dontSee($topSecretUser->userFullName)
            ->dontSee($secretUser->userFullName)
            ->dontSee($secretAccessLevelUser->userFullName);
    }
}
