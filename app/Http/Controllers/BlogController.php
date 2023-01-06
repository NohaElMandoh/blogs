<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DataTables;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.blogs.index');
    }

    public function getBlogsDatatable()
    {
 
        $data = Blog::select('*')->get();
      
        return   Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '';

                $btn .= '<a href="' . Route('blogs.edit', ['id' => $row->id]) . '"  class="edit btn btn-success btn-sm" style="margin-right:5px" ><i class="fa fa-edit"></i></a>';

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
        return view('admin.blogs.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',

            'desc' => 'required',
            'image' => 'required',

        ]);
        $input = $request->all();
        $time = strtotime($request->publish_date);

        $saved = Blog::create([
            'title' => $request->title,
            'desc' => $request->desc,
            'content' => $request->content,
            'publish_date' => date('Y-m-d',$time) ,

        ]);
        if ($request->has('image')) {
            $files = $request->file('image');
            
            foreach ($request->file('image') as $image) {

                // $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $filename = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $fileName = $filename . '.' . $extension; // adding full path

                $path = public_path();
                $destinationPath = $path . '/storage/blogs/';
                $img = \Image::make($image->getRealPath());
                $img->stream(); // <-- Key point
                $image->move($destinationPath, $fileName); // uploading file to given path
                Storage::disk('local')->put('blogs' . '/' . $fileName, $img, 'public');

                $image_path = 'blogs\\' . $fileName;
                $saved->update([
                    'image' => $image_path
                ]);
            }
        }

        if ($saved) {

            return response()->json(['message' => 'Success!']);
        } else {
            return response()->json(['message' => 'Error!']);
        }
    }

    public function edit(Request $request)
    {

        $blog = Blog::find($request->id);

        return view('admin.blogs.edit', compact('blog'));
    }
    public function update(Request $request)
    {

        $request->validate([
            'title' => 'required|string',
            'desc' => 'required',
            'image' => 'required',

        ]);
        $input = $request->all();

        $blog = Blog::find($request->id);
        $time = strtotime($request->publish_date);
        $saved = $blog->update([
            'title' => $request->title,
            'desc' => $request->desc,
            'content' => $request->content,
            'publish_date' => date('Y-m-d',$time) ,

        ]);
        if ($request->has('image')) {
            $files = $request->file('image');
            
            foreach ($request->file('image') as $image) {

                // $fileName   = time() . '.' . $image->getClientOriginalExtension();
                $filename = $image->getClientOriginalName();
                $extension = $image->getClientOriginalExtension();
                $fileName = $filename . '.' . $extension; // adding full path

                $path = public_path();
                $destinationPath = $path . '/storage/blogs/';
                $img = \Image::make($image->getRealPath());
                $img->stream(); // <-- Key point
                $image->move($destinationPath, $fileName); // uploading file to given path
                Storage::disk('local')->put('blogs' . '/' . $fileName, $img, 'public');

                $image_path = 'blogs\\' . $fileName;
                $blog->update([
                    'image' => $image_path
                ]);
            }
        }


        if ($saved) {
            $blog = Blog::where('id', $request->id)->get();
            return response()->json(['message' => 'Success!', 'blog' => $blog]);
        } else {
            return response()->json(['message' => 'Error!']);
        }
    }

    public function delete(Request $request)
    {
        $saved =  Blog::where('id', $request->id)->delete();

        if ($saved) {

            return response()->json(['message' => 'Success!']);
        } else {
            return response()->json(['message' => 'Error!']);
        }
    }

   
}
