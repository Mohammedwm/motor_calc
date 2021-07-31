<?php

namespace App\Http\Livewire;

use App\Models\beneficiary;
use App\Models\employee;
use App\Models\reading;
use Livewire\Component;

class MeterReadComponent extends Component
{
    public $beneficiaries,$employees,$s_numBeneficiary,$s_nameBeneficiary,$from_month,$to_month,$current_reading,$previous_reading,$monthly_use
        ,$price_kilo,$minimum,$monthly_draw,$amount_required,$type_page = 1;
    public function render()
    {
        $this->beneficiaries = beneficiary::all();
        $this->employees = employee::all();

        $readings = reading::orderBy('readings.id','DESC');
        if($this->s_numBeneficiary != ''){
            $readings = $readings->where('beneficiaries_id', $this->s_numBeneficiary);
        }
        if($this->from_month != null){
            if($this->to_month == ''){
                $this->to_month = $this->from_month;
            }
            $readings = $readings->whereBetween('month', [$this->from_month,$this->to_month]);
        }
        if($this->s_nameBeneficiary != ''){
            $readings = $readings->Join('beneficiaries', 'beneficiaries.id', '=', 'readings.beneficiaries_id');
            $readings = $readings->where('beneficiaries.name','LIKE', '%'.$this->s_nameBeneficiary.'%');
        }

        $readings = $readings->paginate(5);

        return view('livewire.read.meter-read-component',['readings' => $readings])->layout('layouts.base',['typePage'=> 2]);
    }
    public function ChangeType($val){
        $this->emit('refreshDropdown');
        $this->type_page = $val;
    }
}
