<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        //Skriv ut kategori-namn istället för siffra 
        foreach($products as $product) {
            $category = Category::find($product->category_id);
            $product->category_id = $category->category;
        }

        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Detta är functionen för att lagra data, dvs "GET"-metoden.
    public function store(Request $request)
    {
        $request->validate([
            'productname' => 'required',
            'description' => 'required',
            'price' => 'required',
            'amount' => 'required',
            'category_id' => 'required',
        ]);

        return Product::create($request->all());
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //Funktion för "POST", dvs lägga till data i databasen (och api)
     public function show($id)
     {
         $product = Product::find($id);
 
         //Om $game inte är tomt (dvs null) så returneras listan
         //Annars returneras ett felmeddelande
         if ($product != null) {
             return $product;
         } else {
             return response()->json([
                 'Product not found'
             ], 404);
         }
     }

     public function destroy($id)
    {
        $product = Product::find($id);

        //Om $game inte är tomt (dvs null) så raderas spelet med ett meddelande
        //Annars returneras ett felmeddelande
        if ($product != null) {
            $product->delete();
            return response()->json([
                'Product deleted'
            ]);
        } else {
            return response()->json([
                'Product not found'
            ], 404);
        }
    }

    public function update(Request $request,$id)
    {
        //
        $product=Product::find($id);
        $product->update($request->all());
        return $product;

    }


    //Denna skulle användas för att hämta ut produkter från en viss kategori men hann aldrig implementera denna
    public function getProductByCategory($id)
    {

        $product = Product::find($id);
        $product = Product::where('category_id', $id)->get();

        //check if items is empty 
        if ($product == null) {
            //if empty -> error
            return response()->json([
                'category not found'
            ], 404);
        } else {
            return $product;
        }
    }
}
