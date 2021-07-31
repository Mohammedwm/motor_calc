<?php

namespace App\Http\Livewire;

use App\Models\beneficiary;
use App\Models\constant;
use Livewire\Component;

class BeneficiaryComponent extends Component
{
    public $constants_status,$constants_type,$beneficiary_id
        ,$name,$phone,$type_id,$status_id,$price_kilo,$place,$registration_dt,$expiry_dt,$minimum
        ,$title_btn = 'حفظ';
    public $s_numBeneficiary,$s_name,$s_phone;
    public function render()
    {
        $this->constants_status = constant::where('main_id',3)->get();
        $this->constants_type = constant::where('main_id',2)->get();
        $beneficiaries = beneficiary::Where('name','LIKE','%'.$this->s_name.'%')
        ->orderBy('id','DESC')->paginate(5);
        return view('livewire.beneficiaries.beneficiary-component',['beneficiaries' => $beneficiaries])->layout('layouts.base',['typePage'=> 4]);
    }
    public function resetInputFields(){
        $this->beneficiary_id = '';
        $this->name = '';
        $this->phone = '';
        $this->type_id = '';
        $this->status_id = '';
        $this->price_kilo = '';
        $this->place = '';
        $this->registration_dt = '';
        $this->expiry_dt = '';
        $this->minimum = '';
        $this->title_btn = 'حفظ';
        $this->emit('Change_select');
    }

    public function storeBeneficiary()
    {
        $this->validate([
            'name' => 'required|unique:beneficiaries',
            'phone' => 'required|numeric|digits:9-10',
            'type_id' => 'required|numeric',
            'status_id' => 'required|numeric',
            'price_kilo' => 'required|numeric',
            'minimum' => 'required|numeric',
            'registration_dt' => 'required|date',
        ]);
        $beneficiary = new beneficiary();
        $beneficiary->name = $this->name;
        $beneficiary->phone = $this->phone;
        $beneficiary->type_id = $this->type_id;
        $beneficiary->status_id = $this->status_id;
        $beneficiary->price_kilo = $this->price_kilo;
        $beneficiary->registration_dt = $this->registration_dt;
        $beneficiary->place = $this->place;
        $beneficiary->minimum = $this->minimum;
        $beneficiary->expiry_dt = empty($this->expiry_dt) ? null : $this->expiry_dt;
        $beneficiary->save();
        session()->flash('message','تم إضافة بيانات المشترك بنجاح !!!');
        $this->resetInputFields();
        $this->emit('hideModelBeneficiary');
    }

    public function editBeneficiary($id)
    {
        $beneficiary = beneficiary::where('id',$id)->first();
        $this->beneficiary_id = $id;
        $this->name = $beneficiary->name;
        $this->phone = $beneficiary->phone;
        $this->type_id = $beneficiary->type_id;
        $this->status_id = $beneficiary->status_id;
        $this->price_kilo = $beneficiary->price_kilo;
        $this->registration_dt = $beneficiary->registration_dt;
        $this->place = $beneficiary->place;
        $this->minimum = $beneficiary->minimum;
        $this->expiry_dt = $beneficiary->expiry_dt;
        $this->title_btn = 'حفظ التعديل';
        $this->emit('Change_select');
    }
    public function updateBeneficiary()
    {
        $this->validate([
            'name' => 'required|unique:beneficiaries,name,'.$this->beneficiary_id,
            'phone' => 'required|numeric|digits:9-10',
            'type_id' => 'required|numeric',
            'status_id' => 'required|numeric',
            'price_kilo' => 'required|numeric',
            'minimum' => 'required|numeric',
            'registration_dt' => 'required|date',
        ]);
        $beneficiary = beneficiary::where('id',$this->beneficiary_id)->first();
        $beneficiary->name = $this->name;
        $beneficiary->phone = $this->phone;
        $beneficiary->type_id = $this->type_id;
        $beneficiary->status_id = $this->status_id;
        $beneficiary->price_kilo = $this->price_kilo;
        $beneficiary->registration_dt = $this->registration_dt;
        $beneficiary->place = $this->place;
        $beneficiary->minimum = $this->minimum;
        $beneficiary->expiry_dt = empty($this->expiry_dt) ? null : $this->expiry_dt;
        $beneficiary->save();
        session()->flash('message','تم تعديل بيانات المشترك بنجاح !!!');
        $this->resetInputFields();
        $this->emit('hideModelBeneficiary');
    }
    public function destroy($id){
        if($id){
            beneficiary::where('id',$id)->delete();
            session()->flash('message','تمت عملية الحذف بنجاح !!!');
        }
    }
}
