<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bList = DB::table('documents')->where('user_id', '=', \Auth::user()->id)->get();

        $aList = DB::table('documents')
            ->join('users', 'users.id', '=', 'documents.user_id')
            ->select('documents.id AS doc_id', 'documents.description',
                'users.name AS stud_name', 'documents.title', 'documents.file')->get();

        return view('student.index', compact('aList', 'bList'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new Document();
        if($request->file('file')){
            $file=$request->file('file');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $request->file->move('storage/', $filename);

            $data->file = $filename;
        }
        $data->title = $request->title;
        $data->description=$request->description;
        $data->user_id = \Auth::id();
        $data->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Document::find($id);
        return view('user.document.details', compact('data'));
    }

    public function download($file){
        return response()->download('storage/'.$file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $docs = Document::findOrFail($id);

        if($docs->delete()) {
            $request->session()->flash('success',  $docs->name.' own file deleted successfully');
        }
        else {
            $request->session()->flash('error', 'File not Deleted. There was an error.');
        }

        return redirect()->route('show_cert');
    }
}
