<?php

use Modules\Contacts\Models\Contact;
use Modules\Serials\Models\Serial;
use Modules\Serials\Models\SerialCode;

uses(Tests\TestCase::class);

test('Can see serials page', function(){
    $this->authenticate();
    $this->get(route('app.serials.index'))->assertOk();
});

test('Can see serials create page', function(){
    $this->authenticate();
    $this->get(route('app.serials.create'))->assertOk();
});

test('Cannot store a serial without a name', function(){
    $this->authenticate();

    $this->post(route('app.serials.store'))->assertInvalid();

    $this->assertDatabaseCount('serials', 0);
});

test('Can store a serial', function(){
    $this->authenticate();

    $this->post(route('app.serials.store', [
        'name' => $this->faker->name(),
        'serial' => Str::random(32),
        'notes' => $this->faker->sentence()
    ]))
    ->assertValid()
    ->assertRedirect(route('app.serials.index'));

    $this->assertDatabaseCount('serials', 1);
});

test('can see serial edit page', function() {
    $this->authenticate();
    $serial = Serial::factory()->create();
    $this->get(route('app.serials.edit', $serial->id))->assertOk();
});

test('can update serial', function() {
    $this->authenticate();

    $serial = Serial::factory()->create();

    $this->patch(route('app.serials.update', $serial->id), [
        'name' => 'Photoshop',
        'serial' => $serial->serial,
        'notes' => $serial->notes
    ])
    ->assertValid()
    ->assertRedirect(route('app.serials.index'));

    $this->assertDatabaseHas('serials', ['name' => 'Photoshop']);
});

test('can delete serial', function() {
    $this->authenticate();
    $serial = Serial::factory()->create();
    $this->delete(route('app.serials.delete', $serial->id))
        ->assertRedirect(route('app.serials.index'));

    $this->assertDatabaseCount('serials', 0);
});
