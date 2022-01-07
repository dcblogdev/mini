<?php

use Modules\Contacts\Models\Contact;

uses(Tests\TestCase::class);

test('can see contact list', function() {
    $this->authenticate();
   $this->get(route('app.contacts.index'))->assertOk();
});

test('can see contact create page', function() {
    $this->authenticate();
   $this->get(route('app.contacts.create'))->assertOk();
});

test('can create contact', function() {
    $this->authenticate();
   $this->post(route('app.contacts.store', [
       'name' => 'Joe',
       'email' => 'joe@joe.com'
   ]))->assertRedirect(route('app.contacts.index'));

   $this->assertDatabaseCount('contacts', 1);
});

test('can see contact edit page', function() {
    $this->authenticate();
    $contact = Contact::factory()->create();
    $this->get(route('app.contacts.edit', $contact->id))->assertOk();
});

test('can update contact', function() {
    $this->authenticate();
    $contact = Contact::factory()->create();
    $this->patch(route('app.contacts.update', $contact->id), [
        'name' => 'Joe Smith',
       'email' => 'joe@joe.com'
    ])->assertRedirect(route('app.contacts.index'));

    $this->assertDatabaseHas('contacts', ['name' => 'Joe Smith']);
});

test('can delete contact', function() {
    $this->authenticate();
    $contact = Contact::factory()->create();
    $this->delete(route('app.contacts.delete', $contact->id))->assertRedirect(route('app.contacts.index'));

    $this->assertDatabaseCount('contacts', 0);
});