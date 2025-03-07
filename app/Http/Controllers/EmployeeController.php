<?php

namespace App\Http\Controllers;
use App\Mail\UserCreatedMail;
use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employees = Employee::all();
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        //

            $employee = Employee::create($request->validated());
            
            if (!$employee) {
                toastr()->error('Không thể thêm người dùng. Vui lòng thử lại!');
                return back()->withInput();
            }
            Mail::to($employee->email)->send(new UserCreatedMail($employee));
            
            toastr()->success('Thêm người dùng thành công!');
            return redirect()->route('employee.index');
        
        }
    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
            $employee = Employee::findOrFail($id);
            
            return view('employees.edit', compact('employee'));
        
    }

  /**
 * Update the specified resource in storage.
 */
public function update(EmployeeRequest $request, $id)
{
    try {
        // Log incoming request data for debugging
        Log::info('Update request received for employee ID: ' . $id);
        Log::info('Validated data:', $request->validated());
        
        // Find the employee
        $employee = Employee::findOrFail($id);
        
        // Attempt to update
        $updated = $employee->update($request->validated());
        
        if (!$updated) {
            Log::error('Failed to update employee ID: ' . $id);
            toastr()->error('Không thể cập nhật thông tin. Vui lòng thử lại!');
            return back()->withInput();
        }
        
        // Log successful update
        Log::info('Successfully updated employee ID: ' . $id);
        toastr()->success('Cập nhật thông tin thành công!');
        return redirect()->route('employee.index');
        
    } catch (\Exception $e) {
        // Log any exceptions
        Log::error('Exception updating employee: ' . $e->getMessage());
        toastr()->error('Đã xảy ra lỗi: ' . $e->getMessage());
        return back()->withInput();
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
        $employee->delete();
        toastr()->success('Xoá thành công');
        return redirect()->route('employee.index');


        }
}
