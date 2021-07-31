<?php

namespace App\Http\Livewire;

use App\Models\constant;
use App\Models\constant_main;
use Livewire\Component;
use Livewire\WithPagination;

class ConstantComponent extends Component
{
    public $constant_mains,$name,$main_id,$const_id,$search,$title_btn = 'حفظ';

    use WithPagination;
    public function render()
    {
        $search = '%'.$this->search.'%';
        $this->constant_mains = constant_main::all();
        $constants = constant::where('name','LIKE',$search)
        ->orderBy('id','DESC')->paginate(4);
        return view('livewire.constant.constant-component',['constants'=>$constants])->layout('layouts.base',['typePage'=> 6]);
    }
    public function resetInputFields(){
        $this->name = '';
        $this->main_id = '';
        $this->const_id = '';
        $this->title_btn = 'حفظ';
        $this->emit('Change_main_id');
    }

    public function storeConstant()
    {
        $this->validate([
            'name' => 'required',
            'main_id' => 'required|numeric'
        ]);
        $constant = new constant();
        $constant->name = $this->name;
        $constant->main_id = $this->main_id;
        $constant->save();
        session()->flash('message','تم إضافة الثابت بنجاح !!!');
        $this->resetInputFields();
        $this->emit('hideModelConst');
    }
    public function editConst($id)
    {

        $constant = constant::where('id',$id)->first();
        $this->const_id = $id;
        $this->name = $constant->name;
        $this->main_id = $constant->main_id;
        $this->title_btn = 'حفظ التعديل';
        $this->emit('Change_main_id');
    }
    public function updateConst()
    {
        $this->validate([
            'name' => 'required|unique:constants,name,'.$this->const_id,
            'main_id' => 'required|numeric'
        ]);

        $constant = constant::where('id',$this->const_id)->first();
        $constant->name = $this->name;
        $constant->main_id = $this->main_id;
        $constant->save();
        session()->flash('message','تم تعديل الثابت بنجاح !!!');
        $this->resetInputFields();
        $this->emit('hideModelConst');
    }
    public function destroy($id){
        if($id){
            constant::where('id',$id)->delete();
            session()->flash('message','تمت عملية الحذف بنجاح !!!');
        }
    }
}
