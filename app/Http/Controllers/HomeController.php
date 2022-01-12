<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Items;
use App\ItemUser;


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    } 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function users()
    {
        return view('admin.user.users');
    }
    
    public function usersListing()
    {
        $user = User::all();
        $items = Items::all();
        return view('admin.user.users_listing')->with(compact('user','items'));
    }
    
    public function createUser(Request $request)
    {
         $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
     return redirect()->route('view_users')->with('message', 'User Create Successfully!');;
    }
    
    public function deleteUser(Request $request)
    {
        User::where('id',$request->id)->delete();
        
     return redirect()->back()->with('message', 'User Delete Successfully!');
    }


    // Items
    public function items()
    {
        return view('admin.item.add');
    }
    
    public function addItems(Request $request)
    {
        // return $request->all();
    
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'max:255'],
            
        ]);
        if ($request->group == 1) {
           $Items = Items::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'phone_num' => $request->phone_num,
            'group' => $request->group,
            ]);
        }
        else {
             $Items = Items::create([
            'name' => $request->name,
            'capacity' => $request->capacity,
            'phone_num' => $request->phone_num,
            'group' => $request->group,
            'iccid' => $request->iccid,
            'source_address' => $request->source_address,

            ]);
        }

         return redirect()->route('view_items')->with('message', 'Item Create Successfully!');;
    }


    public function viewItems()
    {
        $items = Items::all();
        return view('admin.item.view')->with(compact('items'));
    }

  

    
    
   public function deleteItem(Request $request)
    {
        Items::where('id',$request->id)->delete();
        
     return redirect()->back()->with('message', 'Item Delete Successfully!');
    }

    public function assignItems(Request $request)
    {
        $item_id = $request->item_id; 

        foreach($item_id as $item){
            ItemUser::create([
            'item_id' => $item,
            'user_id' => $request->user_id,
            ]);
        }
        return redirect()->back()->with('message', 'Item Assign Successfully!');
    }
    
    public function viewUserIdItems(Request $request)
    {

        $items = ItemUser::where('user_id', $request->id)->with('Items','User')->get();
        return response()->json($items);
    }

    public function viewUserItems()
    {
         $items = ItemUser::where('user_id', Auth::user()->id)->with('Items')->get();
        return view('user.item.view')->with(compact('items'));
    }
    public function deleteUserItem(Request $request)
    {
        ItemUser::where('id',$request->id)->delete();
            
        return redirect()->back()->with('message', 'Item Un-Assigned Successfully!');
    }

}
