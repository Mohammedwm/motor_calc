<?php

namespace App\Http\Livewire;

use App\Models\constant;
use App\Models\employee;
use Livewire\Component;

class EmployeeComponent extends Component
{
    public $constants,$employee_id,$name,$description,$status_id,$search
    ,$title_btn = 'حفظ';
    public function render()
    {
        $search = '%'.$this->search.'%';
        $this->constants = constant::where('main_id',1)->get();
        $employees = employee::where('name','LIKE',$search)->orderBy('id','DESC')->paginate(4);
        return view('livewire.employee.employee-component',['employees'=> $employees])->layout('layouts.base',['typePage'=> 5]);
    }
    public function resetInputFields(){
        $this->name = '';
        $this->description = '';
        $this->status_id = '';
        $this->employee_id = '';
        $this->title_btn = 'حفظ';
        $this->emit('Change_status_id');
    }
    public function storeEmployee()
    {

        $this->validate([
            'name' => 'required|unique:employees',
            'description' => 'required',
            'status_id' => 'required|numeric'
        ]);
        $employee = new employee();
        $employee->name = $this->name;
        $employee->description = $this->description;
        $employee->status_id = $this->status_id;
        $employee->save();
        session()->flash('message','تم إضافة بيانات الموظف بنجاح !!!');
        $this->resetInputFields();
        $this->emit('hideModelEmployee');
    }
    public function editEmployee($id)
    {
        $employee = employee::where('id',$id)->first();
        $this->employee_id = $id;
        $this->name = $employee->name;
        $this->description = $employee->description;
        $this->status_id = $employee->status_id;
        $this->title_btn = 'حفظ التعديل';
        $this->emit('Change_status_id');
    }
    public function updateEmployee()
    {
        $this->validate([
            'name' => 'required|unique:employees,name,'.$this->employee_id,
            'description' => 'required',
            'status_id' => 'required|numeric'
        ]);

        $employee = employee::where('id',$this->employee_id)->first();
        $employee->name = $this->name;
        $employee->description = $this->description;
        $employee->status_id = $this->status_id;
        $employee->save();
        session()->flash('message','تم تعديل بيانات الموظف بنجاح !!!');
        $this->resetInputFields();
        $this->emit('hideModelEmployee');
    }
    public function destroy($id){
        if($id){
            employee::where('id',$id)->delete();
            session()->flash('message','تمت عملية حذف الموظف بنجاح !!!');
        }
    }
}
