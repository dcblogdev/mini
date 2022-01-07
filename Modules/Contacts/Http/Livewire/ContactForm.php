<?php

namespace Modules\Contacts\Http\Livewire;

use Livewire\Component;

class ContactForm extends Component
{
    public function render()
    {
        return view('contacts::livewire.contact-form')->layout('blah');
    }
}
