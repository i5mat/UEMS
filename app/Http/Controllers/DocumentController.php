<?php

namespace App\Http\Controllers;

use App\Certificate;
use App\Document;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $bList = DB::table('documents')
            ->join('users', 'users.id', '=', 'documents.user_id')
            ->select('documents.id AS doc_id', 'documents.description',
                'users.name AS stud_name', 'documents.title', 'documents.file', 'documents.user_id AS usr_id', 'documents.status')
            ->where('user_id', '=', \Auth::user()->id)->get();

        $aList = DB::table('documents')
            ->join('users', 'users.id', '=', 'documents.user_id')
            ->select('documents.id AS doc_id', 'documents.description',
                'users.name AS stud_name', 'documents.title', 'documents.file', 'documents.user_id AS u_id', 'documents.status')->get();

        return view('student.index', compact('aList', 'bList'));

    }

    public function userProfile()
    {
        $user = DB::table('users')->where('id', '=', Auth::user()->id)->first();

        return view('student.profile', compact('user'));
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
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required',
        ]);

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
        $data->status = 0;

        if($data->save()) {
            $request->session()->flash('success',  'File uploaded successfully');
        }
        else {
            $request->session()->flash('error', 'File not Deleted. There was an error.');
        }

        return redirect()->back();
    }

    public function approvalCert(Request $request, $id)
    {
        $docs = Document::findOrFail($id);

        $data = new Certificate();
        $data->user_id = $docs->user_id;
        $docs->status = 1;

        if($data->save() && $docs->save()) {
            $request->session()->flash('success',  'Certificate approved successfully');
        }
        else {
            $request->session()->flash('error', 'Cert not approved. There was an error.');
        }

        return redirect()->route('show_cert');
    }

    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        if($user->save()) {
            $request->session()->flash('success',  $user->name.' profile updated successfully');
        }
        else {
            $request->session()->flash('error', 'Profile info not updated. There was an error.');
        }

        return redirect()->route('user_profile');

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
            $request->session()->flash('success',  'File deleted successfully');
        }
        else {
            $request->session()->flash('error', 'File not Deleted. There was an error.');
        }

        return redirect()->route('show_cert');
    }
}
