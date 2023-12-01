<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\BankAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BankAccountTest extends TestCase
{
    use  RefreshDatabase;

    protected string $endpoint = '/api/bankAccounts';
    protected string $tableName = 'bankAccounts';

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateBankAccount(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $payload = BankAccount::factory()->make([])->toArray();

        $this->json('POST', $this->endpoint, $payload)
             ->assertStatus(201)
             ->assertSee($payload['name']);

        $this->assertDatabaseHas($this->tableName, ['id' => 1]);
    }

    public function testViewAllBankAccountsSuccessfully(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BankAccount::factory(5)->create();

        $this->json('GET', $this->endpoint)
             ->assertStatus(200)
             ->assertJsonCount(5, 'data')
             ->assertSee(BankAccount::first(rand(1, 5))->name);
    }

    public function testViewAllBankAccountsByFooFilter(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BankAccount::factory(5)->create();

        $this->json('GET', $this->endpoint.'?foo=1')
             ->assertStatus(200)
             ->assertSee('foo')
             ->assertDontSee('foo');
    }

    public function testsCreateBankAccountValidation(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        $data = [
        ];

        $this->json('post', $this->endpoint, $data)
             ->assertStatus(422);
    }

    public function testViewBankAccountData(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BankAccount::factory()->create();

        $this->json('GET', $this->endpoint.'/1')
             ->assertSee(BankAccount::first()->name)
             ->assertStatus(200);
    }

    public function testUpdateBankAccount(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BankAccount::factory()->create();

        $payload = [
            'name' => 'Random'
        ];

        $this->json('PUT', $this->endpoint.'/1', $payload)
             ->assertStatus(200)
             ->assertSee($payload['name']);
    }

    public function testDeleteBankAccount(): void
    {
        $this->markTestIncomplete('This test case needs review.');

        $this->actingAs(User::factory()->create());

        BankAccount::factory()->create();

        $this->json('DELETE', $this->endpoint.'/1')
             ->assertStatus(204);

        $this->assertEquals(0, BankAccount::count());
    }
    
}
