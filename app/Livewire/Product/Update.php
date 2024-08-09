<?php

namespace App\Livewire\Product;

use App\Models\Products;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $productId;
    public $title;
    public $description;
    public $price;
    public $image;
    public $imageOld;

    protected $listeners= [ 
        'updateProduct' => 'updateProductHandler',
    ];

    public function updateProductHandler($product){
        $this->productId = $product['id'];
        $this->title = $product['title'];   
        $this->description = $product['description'];
        $this->price = $product['price'];
        $this->imageOld = asset('/storage/' . $product['image']);   
    }
    public function update(){
        $this->validate([
            'title' => 'required|min:3',
            'description' => 'required|max:260',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:4024',
        ]);
        $product = Products::find($this->productId);

        $product->update([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'image' => $this->image ? $this->image->store('products', 'public') : $this->imageOld
        ]);

        $this->dispatch('ProductUpdated');
    }
    public function render()
    {
        return view('livewire.product.update');
    }
}
