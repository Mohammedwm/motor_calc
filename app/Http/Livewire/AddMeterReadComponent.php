<?php

namespace App\Http\Livewire;

use App\Models\beneficiary;
use App\Models\employee;
use App\Models\reading;
use Livewire\Component;

class AddMeterReadComponent extends Component
{
    public $type_page,$beneficiaries,$employees
    ,$beneficiary_id,$employee_id,$month,$current_reading,$previous_reading,$monthly_use
    ,$price_kilo,$minimum,$monthly_draw,$amount_required,$employee_id_1;
    public function render()
    {
        $this->beneficiaries = beneficiary::all();
        $this->employees = employee::all();
        return view('livewire.read.add-meter-read-component')->layout('layouts.base',['typePage'=> 2]);
    }
    public function updatedCurrentReading(){
        if(is_numeric($this->current_reading) && is_numeric($this->previous_reading) && $this->previous_reading <= $this->current_reading){
            $this->monthly_use = $this->current_reading - $this->previous_reading;
            $this->monthly_draw = round($this->monthly_use * $this->price_kilo,2);
            $this->amount_required = $this->monthly_draw > $this->minimum ? $this->monthly_draw : $this->minimum;
        }else{
            $this->monthly_use = '';
            $this->amount_required = '';
        }
    }
    public function resetInputFields(){
        $this->beneficiary_id = '';
        //$this->employee_id = '';
        //$this->month = '';
        $this->current_reading = '';
        $this->previous_reading = '';
        $this->monthly_use = '';
        $this->price_kilo = '';
        $this->minimum = '';
        $this->monthly_draw = '';
        $this->amount_required = '';
        $this->emit('Change_select');
    }
    public function storeReading()
    {
        /*
        $checkReading = reading::where('month',$this->month)
                ->where('beneficiaries_id',$this->beneficiary_id)->first();
        if($checkReading != ''){
            session()->flash('message','قراءة هذا الشهر مدخلة مسبقاً لنفس المشنرك  !!!');
            $this->emit('Change_select');
            return false;
        }
        */
        $this->validate([
            'beneficiary_id' => 'required|numeric|unique:readings,beneficiaries_id,null,id,month,' . $this->month,
            //'beneficiary_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'month' => 'required',
            'current_reading' => 'required|numeric',
            'previous_reading' => 'required|numeric',
            'monthly_use' => 'required|numeric',
            'price_kilo' => 'required|numeric',
            'minimum' => 'required|numeric',
            'monthly_draw' => 'required|numeric',
            'amount_required' => 'required|numeric'
        ]);

        $reading = new reading();
        $reading->beneficiaries_id = $this->beneficiary_id;
        $reading->reader_employee_id = $this->employee_id;
        $reading->month = $this->month;
        $reading->current_reading = $this->current_reading;
        $reading->previous_reading = $this->previous_reading;
        $reading->monthly_use = $this->monthly_use;
        $reading->price_kilo = $this->price_kilo;
        $reading->amount_required = $this->amount_required;
        $reading->minimum = $this->minimum;
        $reading->monthly_draw = $this->monthly_draw;
        //$reading->save();
        //$this->updateBalance($this->beneficiary_id,$this->amount_required);
        session()->flash('message','تم إضافة قراءة الشهر بنجاح  !!!');
        $this->resetInputFields();
        //$this->emit('hideModelEmployee');
    }
    public function changeBeneficiary(){
        if($this->beneficiary_id != ''){

            $beneficiary_data =beneficiary::where('id', $this->beneficiary_id)->first();
            $this->price_kilo = $beneficiary_data->price_kilo;
            $this->minimum = $beneficiary_data->minimum;
            $this->changeMonth();
        }else{
            $this->price_kilo = '';
        }
    }
    public function changeMonth()
    {
        if($this->month > '2000-01' && $this->beneficiary_id != ''){
            $month_back = date("Y-m",  strtotime("$this->month -1 month"));
            $PreviousReading = reading::select('current_reading')->where('month',$month_back)
                ->where('beneficiaries_id',$this->beneficiary_id)->first();
            if($PreviousReading != ''){
                $this->previous_reading = $PreviousReading->current_reading;
            }else{
                $this->previous_reading = 0;
            }

        }else{
            $this->previous_reading = '';
        }

    }
    public function updateBalance($beneficiary_id,$balance){
        $beneficiary = beneficiary::where('id',$beneficiary_id)->first();
        if($beneficiary->balance != ''){
            $beneficiary->balance = $beneficiary->balance + $balance;
        }else{
            $beneficiary->balance = $balance;
        }
        $beneficiary->save();
    }
}
