<?php

namespace App\Http\Livewire;

use App\Models\beneficiary;
use App\Models\employee;
use App\Models\payment;
use App\Models\reading;
use Livewire\Component;

class AddPaymentComponent extends Component
{
    public $beneficiaries,$employees,
    $employee_id,$beneficiary_id,$month,$payment_value,$discount = 0,$the_rest,
    $monthly_use = 0,$previous_payments = 0,$amount_previous = 0,$amount_required = 0;
    public function render()
    {
        $this->beneficiaries = beneficiary::all();
        $this->employees = employee::all();
        return view('livewire.payment.add-payment-component')->layout('layouts.base',['typePage'=> 3]);
    }
    public function changeMonth()
    {
        if($this->month > '2000-01' && $this->beneficiary_id != ''){
            $read = reading::select('amount_required')->where('month',$this->month)
                ->where('beneficiaries_id',$this->beneficiary_id)->first();
            if($read != ''){
                $this->monthly_use = $read->amount_required;
            }else{
                $this->monthly_use = 0;
            }
            $previous_payment = payment::select('payment_value')
                ->where('month',$this->month)
                ->where('beneficiaries_id',$this->beneficiary_id)->sum('payment_value');

            if($previous_payment != ''){
                $this->previous_payments = $previous_payment;
            }else{
                $this->previous_payments = 0;
            }
            /*
            $month_back = date("Y-m",  strtotime("$this->month -1 month"));
            $s_amount_previous = payment::select('the_rest')
            ->where('month',$month_back)
            ->where('beneficiaries_id',$this->beneficiary_id)
            ->orderBy('id', 'asc')
            ->take(1)
            ->first();
            */
            $s_amount_previous = beneficiary::where('id', $this->beneficiary_id)->first();
            if($s_amount_previous != ''){
                $this->amount_previous = round($s_amount_previous->balance - ($this->monthly_use - $this->previous_payments),2);
            }else{
                $this->amount_previous = 0;
            }
            $this->amount_required = $s_amount_previous->balance;
        }else{
            $this->monthly_use = '';
            $this->previous_payments = '';
            $this->amount_previous = '';
        }
    }
    function updatedPaymentValue(){
        if($this->payment_value != ''){
            $this->discount = '' ? 0 : $this->discount;
            $this->the_rest = round($this->amount_required - ($this->payment_value + $this->discount),2);
        }else{
            $this->the_rest = '';
        }
    }
    function updatedDiscount(){
        if($this->discount != ''){
            $this->the_rest = round($this->amount_required - ($this->payment_value + $this->discount),2);
        }else{
            $this->the_rest = '';
        }
    }
    public function resetInputFields(){
        $this->beneficiary_id = '';
        $this->employee_id = '';
        $this->month = '';
        $this->payment_value = '';
        $this->discount = 0;
        $this->the_rest = '';
        $this->monthly_use = '';
        $this->previous_payments = '';
        $this->amount_previous = '';
        $this->amount_required = '';
        $this->emit('Change_select');
    }
    public function storePayment()
    {
        $this->validate([
            'beneficiary_id' => 'required|numeric',
            'employee_id' => 'required|numeric',
            'month' => 'required',
            'monthly_use' => 'required|numeric',
            'amount_previous' => 'required|numeric',
            'amount_required' => 'required|numeric',
            'payment_value' => 'required|numeric',
            'discount' => 'required|numeric',
            'the_rest' => 'required|numeric'

        ]);

        $payments = new payment();
        $payments->beneficiaries_id = $this->beneficiary_id;
        $payments->collector_employee_id = $this->employee_id;
        $payments->month = $this->month;
        $payments->monthly_use = $this->monthly_use;
        $payments->amount_previous = $this->amount_previous;
        $payments->amount_required = $this->amount_required;
        $payments->payment_value = $this->payment_value;
        $payments->discount = $this->discount;
        $payments->the_rest = $this->the_rest;
        $payments->save();
        $this->updateBalance($this->beneficiary_id,($this->payment_value + $this->discount));
        session()->flash('message','تم إضافة الدفعة بنجاح  !!!');
        $this->resetInputFields();
        //$this->emit('hideModelEmployee');
    }
    public function updateBalance($beneficiary_id,$balance){
        $beneficiary = beneficiary::where('id',$beneficiary_id)->first();
        if($beneficiary->balance != ''){
            $beneficiary->balance = $beneficiary->balance - $balance;
        }else{
            $beneficiary->balance = - $balance;
        }
        $beneficiary->save();
    }
}
