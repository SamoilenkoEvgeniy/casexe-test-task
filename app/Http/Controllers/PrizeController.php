<?php

namespace App\Http\Controllers;

use App\Models\Prize;
use Illuminate\Http\Request;

class PrizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = \Auth::user();
        $this->setResponseField('items', $user->prizes);

        return $this->response();
    }

    /**
     * @todo make request validation
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(Request $request)
    {
        $prize = Prize::findOrFail($request->input('prizeId'));
        $prize->changeStatus($request->input('status'));
        return $this->response();
    }

}
