<?php

namespace App\Livewire\Product;

use App\Models\Products;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 10;
    public $formVisible = false;


    protected $listeners = [
        'ProductStored' => 'ProductStoredHandler',
        'formClose' => 'formCloseHandler',
    ];

    public function formCloseHandler(){
        $this->formVisible = false;
    }
    public function ProductStoredHandler(){
        $this->formVisible = false;
        session()->flash('message', 'Product Stored Successfully');
    }
    public function formToggle(){
        $this->formVisible = !$this->formVisible;
    }
    public function render()
    {
        return view('livewire.product.index', [
            'products' => $this->search === null ? 
             Products::latest()->paginate($this->paginate) : 
             Products::where('title', 'like', '%' . $this->search . '%')
             ->paginate($this->paginate)
        ])->extends('layouts.app');
    }
}
