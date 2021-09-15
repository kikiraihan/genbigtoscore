<?php

namespace App\Http\Livewire\Desktop;

use App\Models\anggota;
use App\Models\anggota_timkhu;
use App\Models\Timkhu;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class ManualTimkhuAnggota extends Component
{

    use WithPagination;

    public $idTim;

    // untuk form
    public 
    $id_abar,//anggota baru
    $peran,
    
    $searchSelectAbar,
    $terpilihSelectAbar;

    // untuk edit
    public 
    $metode,
    $idToUpdate;

    //index
    public $search;

    public function mount($id)
    {
        $this->metode='newTimkhuAnggota';
        $this->idTim=$id;
    }

    protected $CustomMessages = [
        'string' => 'Kolom :attribute, harus berupa teks',
        'required'=>'Kolom :attribute tidak boleh kosong',
        'unique'=>'Data kolom :attribute sudah ada sebelumnya',
    ];
    
    protected $listeners=[
        'anggotaTimkhuFixHapus'=>'delete'
    ];

    public function render()
    {
        $tim=Timkhu::findOrFail($this->idTim)->load('anggotas','kepala');
        $anggota=$tim
            ->anggotas()
            ->HanyaYangAktif()//scope
            ->bernama($this->search)
            // ->orderBy('pivot_nilai', 'desc')
            ;

        return view('livewire.desktop.manual-timkhu-anggota',[
            'tim'=>$tim,
            'isiTabel'=>$anggota->paginate(30),
            'selectAbar'=>$this->selectabar(),
        ]);
    }

    public function selectabar()
    {
        return 
        anggota::query()
        ->HanyaYangAktif()
        ->Bernama($this->searchSelectAbar)
        ->get()->take(7);
    }

    public function setAbar($param)
    {
        $this->id_abar=$param[0];
        $this->terpilihSelectAbar=$param[1];
    }

    public function newTimkhuAnggota()
    {

        $this->validate([
            'id_abar'           =>'required|integer',
            'peran'             =>'required|in:kepala,anggota,pengurus-inti',
        ], $this->CustomMessages);
        
        $tim=Timkhu::find($this->idTim);
        if($tim->anggotas()->where('id_anggota',$this->id_abar)->first())
            $this->emit('swalMessageError','anggota sudah ada');
        
        else
        {
            $tim->anggotas()->attach($this->id_abar, ['peran' => $this->peran]);
            // dd('jad');
            $tim->save();
            
            $this->emit('swalAdded');
            $this->reset([
                'id_abar',
                'peran',
                'searchSelectAbar',
                'terpilihSelectAbar',
            ]);
        }
        
    }


    public function delete($id)
    {
        $toDetach=Timkhu::find($this->idTim);
        $toDetach->anggotas()->detach($id);
        $this->mount($this->idTim);
    }



    public function ganti($param)
    {
        $ke=anggota_timkhu::find($param[0]);
        $ke->nilai=$param[1];
        $ke->save();
        $this->emit('swalUpdated');
        $this->render();
    }
}
