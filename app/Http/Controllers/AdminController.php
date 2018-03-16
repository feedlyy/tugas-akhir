<?php

namespace App\Http\Controllers;

use App\Rules\Lowercase;
use Illuminate\Http\Request;
use App\Admin;
use App\Status;
use App\Rules\Kapital;
use App\Rules\Uppercase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Admin::all();
        return view('Admin.Admin')->with('admin', $admin);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $status = Status::all();
        $admin = Admin::all();
        return view('Admin.TambahAdmin')
            ->with('admin', $admin)
            ->with('status', $status);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
            $validasi = $request->validate([
                'nama_admin' => ['required', new Lowercase, 'unique:admins,nama_admin'],
                'password' => ['required'],
                'selectstatus' => ['required']
            ]);

            $admin = new Admin;
            /*penjelasan $admin->id_admin(ini yang ada di kolom table)
            sedangkan $request->id_admin(ini name yang ada di input view nya)
            kebetulan dibikin sama name nya*/
            /*$admin->id_admin = $request->id_admin;*/


            $admin->nama_admin = $request->nama_admin;
            $admin->password = bcrypt($request->password);
            $admin->id_status = $request->selectstatus;

            /*ini adalah konsep linked list yang diajarkan faldy
            jadi dimana terdapat parent_id untuk pengganti id_departemen/id_prodi yang
            seharusnya ada di table admin
            jadi dengan adanya linked list, dapat menentukan admin ini bagian dari siapa
            contoh: vokasi memiliki id_admin 1 dan parent_id null
            nanti ketika menambahkan departemen baru, misal tedi dengan id_admin 2
            maka parent_id tedi akan menjadi 1(karena tedi merupakan fakultas vokasi)
            dan begitu pula jika menambahkan prodi, misal komsi
            maka komsi akan memiliki parent_id = 2. karena komsi merupakan departemen tedi
            dan seterusnya*/

            if (Auth::user()->id_status == 1){
                if ($request->selectstatus == 2){
                    $admin->parent_id = Auth::user()->id_admin;
                } elseif($request->selectstatus == 3){
                    $admin->parent_id = $request->selectdepartemen;
                }
            } else{
                $admin->parent_id = Auth::user()->id_admin;
            }

            $admin->save();
            return redirect('admin/admin')->with(session()->flash('status', ''));




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
        //
        $admin =  Admin::find($id);
        return view('Admin.AdminEdit')->with('admin', $admin);
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
        $validasi = $request->validate([
            'password_baru' => ['required', 'same:konfirm_password'],
            'konfirm_password' => ['required', 'same:password_baru']
        ]);

        $admin = Admin::find($id);

        $admin->password = bcrypt($request->konfirm_password);
        $admin->save();

        return redirect('admin/admin')->with(session()->flash('update', ''));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $admin = Admin::find($id);
        $admin->delete();

        return redirect('admin/admin')->with(session()->flash('hapus', ''));
    }
}
