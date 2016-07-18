<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Group;
use App\User;
use DB;
use Debugbar;
use App\Http\Requests\GroupPostRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::paginate(15);

        $request->session()->put("paginator",$groups);

        return view('group.index', ['groups' => $groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.form', ['action' => 'create']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GroupPostRequest $request)
    {
        $netID = $request->input("_netID");
        $firstName = $request->input("_firstName");
        $lastName = $request->input("_lastName");

        DB::beginTransaction();
        $group = Group::create($request->only(['name', 'description']));

        foreach($netID as $key => $value ) {
            $tmp = ['netid' => $netID[$key],
                    'first_name'=>$firstName[$key], 
                    'last_name'=>$lastName[$key]];

            $owner = User::where('netid',$netID[$key])->first();

            //var_dump(!$owner);
            //die();

            if(!$owner){
                $group->owners()->save(User::create($tmp)); // no unique constraint check
            }else{
                $owner->update($tmp);
                $group->owners()->save($owner);
            }
        }

        DB::commit();

        return redirect()->route('group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = Group::find($id);

        //Debugbar::info($r->owners());

        //var_dump($group->owners());

        return view('group.form', ['action' => 'edit', 'group' => $group]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupPostRequest $request, $id)
    {
        // Validate the request...

        $group = Group::find($id);

        $netID = $request->input("_netID");
        $firstName = $request->input("_firstName");
        $lastName = $request->input("_lastName");

        DB::beginTransaction();
        $group->update($request->only(['name', 'description']));

        $group->owners()->detach();
        foreach($netID as $key => $value ) {
            $tmp = ['netid' => $netID[$key],
                    'first_name'=>$firstName[$key], 
                    'last_name'=>$lastName[$key]];

            $owner = User::where('netid',$netID[$key])->first();

            //var_dump(!$owner);
            //die();

            if(!$owner){
                $group->owners()->save(User::create($tmp)); // no unique constraint check
            }else{
                $owner->update($tmp);
                $group->owners()->save($owner);
            }
        }

        DB::commit();

        return redirect()->route('group.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Group::destroy($id);
        return redirect()->route('group.index');
    }

    private function setGroup(Request $request)
    {

    }
}
