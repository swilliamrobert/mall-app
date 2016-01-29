<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Shop;
use File;
class ShopController extends Controller
{
	/**
    * Display a listing of the resource.
    *
    * @return Response
    */
    public function index()
    {
      $shops = Shop::all();
      return \View::make('mall')->with('shops',$shops);
    }
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	*/
    public function store(Request $request){
    	 $shop = Shop::create($request->all());
    	 return \Response::json($shop);
    }
    /**
    * Display the specified resource.
    *
    * @param  int $shop_id
    * @return Response
    */
    public function show($shop_id)
    {
       $shop = Shop::find($shop_id);
       return \Response::json($shop);
    }

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  Request $request, int  $shop_id
	 * @return Response
	 */
	public function update(Request $request,$shop_id)
	{
	 
		  $shop = Shop::find($shop_id);
		  $shop->name = $request->name;
	    $shop->floor = $request->floor;
	    $shop->lot_no = $request->lot_no;
	    $shop->save();
	    return \Response::json($shop);
	}
    
	/**
    *
    * @return Response::Download as txt file
    */
    public function download()
    {
      $shops = Shop::all();
      $filename = "shop.txt";
	    $handle = fopen($filename, 'w+');
	    foreach($shops as $row) {
	        fputcsv($handle, array($row['name'], $row['floor'], $row['lot_no']));
	    }
	    fclose($handle);
	    $headers = array(
	        'Content-Type' => 'txt',
	    );
	    return \Response::download($filename, 'shops.txt', $headers);
    }
   /**
    * upload the specified resource from storage.
    *
    * @return Response::Download as txt file
    */
   public function upload() {
	  $filename = Input::file('file');
     if (File::exists($filename)) {
          try
            {
                $file = fopen("$filename","r");
                $row = array();
                while(! feof($file))
                  {
                  $row =  fgets($file);
                  $split_row = explode(',', $row);
                  if(count($split_row) > 1){
                  $this->processRow($split_row);
                  }
                  }
                  fclose($file);
            }
            catch (Illuminate\Filesystem\FileNotFoundException $exception)
            {
                die("The file doesn't exist");
            }
     }
     $shops = Shop::all();
     return \View::make('mall')->with('shops',$shops);

	}
    /**
    * Insert or Update table from txt file.
    *
    * @param  array  $split_row
    * @return Response
    */
    public function processRow($split_row)
    {   
        $mall_name = $split_row[0];
        $floor = $split_row[1];
        $lot_no = $split_row[2];
        $shop = Shop::where('name', $mall_name)->first();
        if(isset($shop)){
            $shop->name = $mall_name;
            $shop->floor = $floor ;
            $shop->lot_no =  $lot_no;
            $shop->save();
        }else{
            $shop = new Shop;
            $shop->name   = $mall_name;;
            $shop->floor  = $floor;
            $shop->lot_no = $lot_no;
            $shop->save();
        }
        
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $shop_id
    * @return Response
    */
    public function destroy($shop_id)
    {
       $shop = Shop::destroy($shop_id);
       return \Response::json($shop);
    }
}
