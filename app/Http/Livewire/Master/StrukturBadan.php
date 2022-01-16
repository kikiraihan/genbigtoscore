<?php

namespace App\Http\Livewire\Master;

use App\Models\Badan;
use Livewire\Component;

class StrukturBadan extends Component
{
    protected $listeners=[
        'terkonfirmasiEditMasterBadan'=>'fixEdit',
        'terkonfirmasiTambahMasterBadan'=>'fixTambah',
        'masterBadanFixHapus'=>'fixHapus',
    ];

    // untuk index
    public
    $search;

    public function render()
    {
        $b=Badan::with(['units'])
            ->where('nama', 'like', '%'.$this->search.'%')
            ;
        
        return view('livewire.master.struktur-badan',[
            'isiTabel'=>$b->paginate(30),
        ]);
    }

    public function fixEdit($value, $id)
    {
        $b=Badan::find($id);
        $b->nama=$value;
        $b->save();
        
        $this->emit('swalUpdated');
    }

    public function fixHapus($id)
    {
        $b=Badan::find($id);
        if($b->units->isNotEmpty())
            $this->emit('swalMessageError','Tidak dapat menghapus! karena masih memiliki unit yang terhubung');
        else
            $b->delete();
    }

    public function fixTambah($value)
    {
        $b=new Badan;
        $b->nama=$value;
        $b->save();
        
        $this->emit('swalAdded');
    }
}
