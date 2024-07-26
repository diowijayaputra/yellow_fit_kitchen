<?php

namespace App\Http\Controllers;

use App\Models\Login;
use App\Models\Costumer;
use App\Models\Goals;
use App\Models\Data;

use Illuminate\Http\Request;

class YFKController extends Controller
{
    public function login(Request $request, $email, $password)
    {
        $users = Login::where('email', $email)->get();
        $userData = response()->json($users)->getData();

        if (count($userData) > 0) {
            foreach ($users as $user) {
                $emailVal = $user->email;
                $passVal = $user->password;

                if ($password != $passVal) {
                    return 1;
                } else {
                    return 2;
                }
            }
        } else {
            return 0;
        }
    }

    public function data(Request $request)
    {
        $data = $request->validate([
            'label' => 'required',
            'kategori' => 'required',
        ]);

        Data::create($data);
    }

    public function getData()
    {
        $getData = Data::all();
        return response()->json($getData);
    }

    public function getModalData(Request $request, $id)
    {
        $label = Data::where('id', $id)->get('label');
        return response()->json($label);
    }

    public function editData(Request $request, $id)
    {
        $data = $request->validate([
            'label' => 'required',
            'kategori' => 'required',
        ]);

        $editData = Data::where('id', $id);

        if ($editData) {
            $editData->update($data);
            return response()->json(['message' => 'Data updated successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }

    public function deleteData(Request $request, $id)
    {
        $data = $request->validate([
            'id' => 'required',
        ]);

        $deleteQueue = Data::where('id', $id);

        if ($deleteQueue) {
            $deleteQueue->delete($data);
            return response()->json(['message' => 'Data deleted successfully']);
        } else {
            return response()->json(['message' => 'Data not found'], 404);
        }
    }
}
