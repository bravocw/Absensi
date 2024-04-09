<?php

namespace App\Http\Controllers\Penguruss\Ajax;

use App\Barang;
use App\User;
use App\BarangLocation;
use App\Http\Controllers\Controller;
use App\SchoolOperationalAssistance;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class PengurusAjaxController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|string', // Validasi untuk role
        ]);
        $deskripsi = $request->role . " Kelas " . $request->detail;
        $avatars = ['avatar-1', 'avatar-2', 'avatar-3', 'avatar-4', 'avatar-5'];
        $randomAvatar = $avatars[array_rand($avatars)]; // Pilih satu secara acak

        $barangs = new User();
        $barangs->name = $request->name;
        $barangs->email = $request->email;
        $barangs->role = $request->role;
        $barangs->deskripsi = $deskripsi;
        $barangs->photo = $randomAvatar;
        $barangs->password = Hash::make($request->password);
        $barangs->save();

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $barangs], 200);
    }

    public function show($id)
    {
        $barang = User::findOrFail($id);

        $data = [
            'name' => $barang->name,
            'email' => $barang->email,
            'password' => $barang->password,
        ];

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $data], 200);
    }



    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return response()->json(['status' => 200, 'message' => 'Success'], 200);
    }
}
