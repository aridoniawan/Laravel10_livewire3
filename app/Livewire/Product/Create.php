<?php

namespace App\Livewire\Product;

use App\Models\Products;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title;
    public $description;
    public $price;
    public $image;

    public function store(){
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:260',
            'price' => 'required|numeric',
            'image' => 'required|image|max:4024',
        ]);

        Products::create([
            'user_id' => auth()->user()->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image->store('products', 'public'),
        ]);

        $this->dispatch('ProductStored');
    }
    public function render()
    {
        return view('livewire.product.create');
    }
}
