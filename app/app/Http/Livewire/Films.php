<?php

namespace App\Http\Livewire;

use App\Models\Film;
use Carbon\Carbon;
use Livewire\Component;

class Films extends Component
{
    public $films, $title, $overview, $product_id;
    public $isOpen = 0;

    public function render()
    {
        $this->films = Film::all();
        return view('livewire.products');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->overview = '';
        $this->product_id = '';
    }

    public function store()
    {
        $this->validate([
            'title' => 'required',
            'overview' => 'required',
        ]);

        if ($this->product_id) {
            $this->updateFilm();
        } else {
            $this->createFilm();
        }

        session()->flash(
            'message',
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
    }

    private function createFilm()
    {
        $film = new Film();
        $film->id = mt_rand(100000, 999999); // Generate a unique integer ID within the range of 100000 to 999999
        $film->title = $this->title;
        $film->overview = $this->overview;
        $film->created_at = Carbon::now();
        $film->updated_at = Carbon::now();
        $film->save();
    }

    private function updateFilm()
    {
        $film = Film::find($this->product_id);
        if ($film) {
            $film->title = $this->title;
            $film->overview = $this->overview;
            $film->updated_at = Carbon::now();
            $film->save();
        }
    }

    public function edit($id)
    {
        $film = Film::findOrFail($id);
        $this->product_id = $id;
        $this->title = $film->title;
        $this->overview = $film->overview;

        $this->openModal();
    }

    public function delete($id)
    {
        Film::find($id)->delete();
        session()->flash('message', 'Product Deleted Successfully.');
    }
}
