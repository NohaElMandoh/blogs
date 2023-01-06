<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DataTables;

class SubscribersController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.subscribers.index');
    }
    // public function index(UsersDataTable $dataTable)
    // {
    //     return $dataTable->render('admin.subscribers.index');
    // }
    public function getUsersDatatable()
    {

        $data = User::select('*')->get();

        return   Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';

                $btn .= '<a href="' . Route('users.edit', ['id' => $row->id]) . '"  class="edit btn btn-success btn-sm" style="margin-right:5px" ><i class="fa fa-edit"></i></a>';

                $btn .= 
                '<a href=""  data-id="' . $row->id . '" class="edit deleteBtn btn btn-danger btn-sm" ><i class="fa fa-trash"></i></a>';
            
                return $btn;
            })
            ->addColumn('status', function ($row) {
                return $row->status == 0 ? 'Not activated' : 'Active';
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }

    public function create()
    {
        return view('admin.subscribers.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',

            'email' => 'required|unique:users',
            'password' => 'required',

        ]);
        $input = $request->all();


        $saved = User::create([
            'name' => $request->name,

            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        if ($saved) {

            return response()->json(['message' => 'Success!']);
        } else {
            return response()->json(['message' => 'Error!']);
        }
    }

    public function edit(Request $request)
    {

        $user = User::find($request->id);

        return view('admin.subscribers.edit', compact('user'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'email' => 'required',
            'password' => 'required',

        ]);
        $input = $request->all();

        $user = User::find($request->id);

        $saved = $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
            'password' => bcrypt($request->password),
        ]);

        
        if ($saved) {
            $user = User::where('id',$request->id)->get();
            return response()->json(['message' => 'Success!', 'user' => $user]);
        } else {
            return response()->json(['message' => 'Error!']);
        }
    }

    public function delete(Request $request)
    {
          $saved=  User::where('id', $request->id)->delete();
       
        if ($saved) {
      
            return response()->json(['message' => 'Success!']);
        } else {
            return response()->json(['message' => 'Error!']);
        }
    }
}
