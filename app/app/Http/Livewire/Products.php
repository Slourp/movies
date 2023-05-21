<?php

namespace App\Http\Livewire;


use App\Models\Film;
use Livewire\Component;
use App\Models\Product;

class Products extends Component
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

        Product::updateOrCreate(['id' => $this->product_id], [
            'title' => $this->title,
            'overview' => $this->overview
        ]);

        session()->flash(
            'message',
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.'
        );

        $this->closeModal();
        $this->resetInputFields();
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
