<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Province;
use App\Stay;
use App\User;
use App\Comment;


class staysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $stays = Stay::orderBy('created_at', 'desc')
        ->with('province')
        ->paginate(9);

        return view('stays.index', [
          'stays' => $stays
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stays = Stay::all();
        $provinces = Province::all();

        return view('stays.create', [
          'stays' => $stays,
          'provinces' => $provinces
        ]);
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
      'title' => 'required|max:255',
      'description' => 'required|max:255',
      'datetime' => 'required',
      'location' => 'required',
      'whatsappurl' => 'max:255',
      //'user_id' => 'required',
      'province_id' => 'required',
    ]);

    $stays = new Stay;
    $stays->title = $request->title;
    $stays->description = $request->description;
    $stays->datetime = $request->datetime;
    $stays->location = $request->location;
    $stays->whatsappurl = $request->whatsappurl;
    $stays->user_id =  Auth::user()->id;
    $stays->province_id = $request->province_id;
    $stays->save();

      return redirect('stays');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

      $stay = Stay::where('id', $id)
            ->with('user')
            ->with('province')
            ->first();

      $comments = Comment::where('stay_id', '=', $id)
      ->orderBy('created_at', 'desc')
      ->with('user')
      ->with('stay')
      ->paginate(5);

      return view('stays.show', [
          'stay' => $stay,
          'comments' =>$comments
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $stay = Stay::where('id', $id)->first();
      $provinces = Province::all();

      return view('stays.edit', [
            'stay' => $stay,
            'provinces' => $provinces,
        ]);
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
      $this->validate($request, [
        'title' => 'required|max:255',
        'description' => 'required|max:255',
        'datetime' => 'required',
        'location' => 'required',
        'whatsappurl' => 'max:255',
        //'user_id' => 'required',
        'province_id' => 'required',
      ]);

      $stays = Stay::findOrFail($id);
      $stays->title = $request->title;
      $stays->description = $request->description;
      $stays->datetime = $request->datetime;
      $stays->location = $request->location;
      $stays->whatsappurl = $request->whatsappurl;
      $stays->province_id = $request->province_id;
      $stays->save();

        return redirect('stays');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $stay = Stay::where('id', $id)->delete();
      $comments = Comment::where('stay_id', '=', $id)->delete();

      return redirect('users');
    }

    public function storeComments(Request $request)
    {

    $this->validate($request, [
      'message' => 'required|max:255',
    ]);

    $stay_id = $request->stay_id;

    $comments = new Comment;
    $comments->message = $request->message;
    $comments->user_id =  Auth::user()->id;
    $comments->stay_id = $request->stay_id;
    $comments->save();

      return redirect()->to('stays/'.$stay_id);

    }

    public function destroyComment($id)
    {
      $comment = Comment::where('id', $id)->delete();

      $stay_id = Stay::where('id', $id)->first();

      return redirect()->to('stays/');
    }
}
