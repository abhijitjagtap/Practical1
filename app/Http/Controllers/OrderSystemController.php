<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\OrderSystem;

class OrderSystemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $object = OrderSystem::orderBy('updated_at', 'DESC')->first();


        if (!empty($object['numbers_of_row'])) {
            $data['rows'] = $object['numbers_of_row'];
        } else {
            $data['rows'] = 0;
        }
        if (!empty($object->numbers_of_column)) {
            $data['col'] = $object->numbers_of_column;
            $data['id'] = $object->id;
        } else {
            $data['col'] = 0;
        }
        if (!empty($object->item_details)) {
            $item_details = $object->item_details;
            $data1 = [];
            foreach ($item_details['data'] as $i => $k) {
                $data1[$k['rowId']]['rowid'] = $k['rowId'];
                foreach ($k['item'] as $kk => $vv) {

                    $data1[$k['rowId']]['item'][$kk]['col'] = $vv['col_id'];
                    $data1[$k['rowId']]['item'][$kk]['item_name'] = $vv['item_name'];
                    $data1[$k['rowId']]['item'][$kk]['price'] = $vv['price'];
                }
            }
            $data['item_details'] = $data1;
        } else {
            $data['item_details'] = [];
        }
      
        return view('welcome', compact('data'));
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
    public function getmodal(Request $request)
    {

        $data['rowid'] = $request->row;
        $data['colid'] = $request->col;

        return view('create_item')->with(compact('data'))->render();
    }

    public function updateItem(Request $request)
    {
        $obj = OrderSystem::where(["id" => $request->id])->first();
        //dd($request->all());
        $item_details = $obj->item_details;
        $p_details = [];
        $list = [];
        if (is_null($item_details)) {
            $list['col_id'] = $request->colId;
            $list['item_name'] = $request->item_name;
            $list['price'] = $request->item_price;
            $p_details['data'][] = ["rowId" => $request->rowID, "item" => [$list]];
        } else {
            $existig_data = $item_details['data'];
            foreach ($existig_data as $key => $value) {
                if ($request->rowID == $value['rowId']) {
                    foreach ($value['item'] as $k => $v) {
                        $list['col_id'] = $request->colId;
                        $list['item_name'] = $request->item_name;
                        $list['price'] = $request->item_price;
                        if ($request->colId == $v['col_id']) {
                            $existig_data[$key]['item'] = [$list];
                        } else {
                            $existig_data[$key]['item'] = array_merge($value['item'], [$list]);
                        }
                    }
                } else {
                    $list['col_id'] = $request->colId;
                    $list['item_name'] = $request->item_name;
                    $list['price'] = $request->item_price;
                    $existig_data[] = ["rowId" => $request->rowID, "item" => [$list]];
                    // $existig_data11 = array_merge($existig_data, $existig_data);
                }
            }
            $p_details['data'] = $existig_data;
        }
        // echo "<pre>";
        // print_r($p_details);
        // exit;
        $obj->item_details = $p_details;
        $obj->updated_at = now();
        if ($obj->save()) {
            $success = true;
            $message = "Saved Data";
            $response = [
                'success' => $success,
                'msg' => $message
            ];
            return response()->json($response, 200);
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $collection)
    {
        $id = OrderSystem::select('id')->where([['numbers_of_row', $collection->rowID], ['numbers_of_column', $collection->colId]])->first();


        if (is_null($id)) {
            $order = new OrderSystem;
        } else {
            $order = OrderSystem::find($id['id']);
            $order->updated_at = now();
        }

        $order->numbers_of_row = $collection['rowID'];
        $order->numbers_of_column = $collection['colId'];
        // dd($order);
        // exit;
        if ($order->save()) {
            $success = true;
            $message = "Saved Data";
            $response = [
                'success' => $success,
                'msg' => $message
            ];
            return response()->json($response, 200);
        }
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
    public function destroy($id)
    {
        //
    }
}
