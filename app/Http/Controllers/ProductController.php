<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Item;
use Auth;
use Illuminate\Support\Carbon;



class ProductController extends Controller
{
   public function index(){
      $details = Item::latest()->paginate(5);
      $trashed = Item::onlyTrashed()->latest()->paginate(3);
      // $total = Item.item_quantity * Item.unit_price;
      return view('Customer.invoice.index',compact('details','trashed'));
   }

   public function addItem(Request $request){
      $validate = $request->validate([
         'item_name' => 'required|unique:items|max:255',
         'item_description' => 'required|max:255',
         'item_quantity' => 'required|max:255',
         'unit_price' => 'required',

      ]);

      Item::insert([
         'item_name' => $request->item_name,
         'item_description' => $request->item_description,
         'item_quantity' => $request->item_quantity,
         'unit_price' => $request->unit_price,
         'user_id' => Auth::user()->id, 
         'created_at' => Carbon::now()

      ]);
      return Redirect()->back()->with('success','item added Successfully');

   }
   
   public function editItem($id){

      $items = Item::find($id);
      return view('Customer.invoice.edit',compact('items'));

   }
   
   public function updateItem(Request $request, $id){
      $update = Item::find($id)->update([
         'item_name' => $request->item_name,
         'item_description' => $request->item_description,
         'item_quantity' => $request->item_quantity,
         'unit_price' => $request->unit_price,
         'user_id' => Auth::user()->id, 
         'updated_at' => Carbon::now()
      ]);

      return Redirect()->route('invoice')->with('success','Item Updated Successfully');

   }

   // delete item temp
   public function Delete($id) {
      $delete = Item::find($id)->delete([
         'deleted_at' => Carbon::now()
      ]);
      return Redirect()->back()->with('success','item has been moved to recycle bin');

   }

   // Restore
   public function Restore($id){
      $restore = Item::withTrashed()->find($id)->restore();
      return Redirect()->back()->with('success','Item has been restored');

   }


   // Wipe

   public function Wipe($id) {
      $wipe = Item::onlyTrashed()->find($id)->forceDelete();
      return Redirect()->back()->with('success','Item has been permanently deleted');

   }
}
