<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\OrderSystem;
use App\Repository\ItemRepository;

class OrderSystemController extends Controller
{

    public $item;

    public function __construct(ItemRepository $item)
    {
        $this->item = $item;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = $this->item->getRowColumn();
      
        return view('welcome', compact('data'));
    }

    //open model for Item
    public function getmodal(Request $request)
    {

        $data['rowid'] = $request->row;
        $data['colid'] = $request->col;

        return view('create_item')->with(compact('data'))->render();
    }

    public function updateItem(Request $request)
    {

        $response = $this->item->addItem($request);
        return response()->json($response, 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $collection)
    {
        $response = $this->item->addRowColumn($collection);
        return response()->json($response, 200);
    }
}
