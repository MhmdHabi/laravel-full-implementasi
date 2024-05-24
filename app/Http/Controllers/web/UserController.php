<?php

namespace App\Http\Controllers\Web;

use App\Exports\DashboardExport;
use App\Exports\ProductExport;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Imports\importProduct;
use App\Models\Post;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Contracts\Service\Attribute\Required;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        return view('layouts.master');
    }
    public function dashboard(Request $request, User $user)
    {
        $user = Auth::user();

        return view('dashboard', ['user' => $user]);
    }


    public function getAdmin(User $user)
    {
        // $products = Product::where('user_id', $user->id)->get();
        $products = Product::all();
        return view('admin_page', ['products' => $products]);
    }

    public function detailProduct(Product $product)
    {

        return view('detail_product', ['product' => $product]);
    }
    public function detailTransaksi(Request $request, Product $product, User $user)
    {
        $user = Auth::user();
        $product = Product::find($request->product_id);


        $adminFee = 2500;
        $uniqueCode = Transaksi::max('unique_code') + 1;
        $total = $product->price + $adminFee;

        $transaksi = Transaksi::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'invoice_number' => now()->timestamp,
            'admin_fee' => $adminFee,
            'unique_code' => $uniqueCode,
            'total' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'expiration_date' => now()->addHours(3),
        ]);

        return view('dashboard', compact('transaksi', 'product', 'user'));
    }

    public function editProduct(Request $request, Product $product)
    {
        return view('edit_product', ['product' => $product]);
    }

    public function updateProduct(ProductRequest $request, User $user, Product $product)
    {


        if ($request->hasFile('image')) {

            $imagePath = $request->file('image')->store('public/images');
            $imageName = basename($imagePath);

            $product->image = $imageName;
        }
        $product->name = $request->nama;
        $product->stock = $request->stok;
        $product->weight = $request->berat;
        $product->price = $request->harga;
        $product->description = $request->deskripsi;
        $product->condition = $request->kondisi;
        $product->save();


        return redirect()->route('admin_page')->with('message', 'Berhasil update data');
    }

    public function deleteProduct(Request $request, User $user, Product $product)
    {
        // if ($product->user_id === $user->id) {
        //     $product->delete();
        // }
        $product->delete();
        return redirect()->back()->with('status', 'Berhasil menghapus data');
    }


    public function getFormRequest()
    {
        return view('form_request');
    }


    public function handleRequest(Request $request, User $user)
    {
        return view('handle_request');
    }

    public function postRequest(ProductRequest $request, User $user)
    {

        $imagePath = $request->file('image')->store('public/images');
        $imageName = basename($imagePath);
        Product::create([
            'image' => $imageName,
            'name' => $request->nama,
            'weight' => $request->berat,
            'price' => $request->harga,
            'condition' => $request->kondisi,
            'stock' => $request->stok,
            'description' => $request->deskripsi,
        ]);

        return redirect()->route('admin_page');
    }

    public function getProduct(Request $request, User $user)
    {
        $user = Auth::user();
        // $userAuth = User::find($user->id);
        // dd($user->roles[1]->name);
        // $user = User::find(1);
        // $data = $user->products;
        $data = Product::all();

        return view('products')->with('products', $data);
    }


    public function getProfile(Request $request, User $user)
    {
        $user = Auth::user();

        return view('profile', ['user' => $user]);
    }

    public function login()
    {
        return view('login');
    }

    public function loginGoogle(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogleCallback(Request $request)
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->email)->first();
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = new User();
            $newUser->google_id = $user->id;
            $newUser->name = $user->name;
            $newUser->email = $user->email;
            $newUser->password = Hash::make(Str::random(15));
            $newUser->gender = 'male';
            $newUser->age = 25;
            $newUser->birth = '2001-01-10';
            $newUser->address = 'Bogor';
            $newUser->save();

            Auth::login($newUser);
        }
        return redirect()->route('dashboard');
    }

    public function register()
    {
        return view('register');
    }

    public function importProduct(Request $request)
    {

        DB::beginTransaction();
        try {
            $user = Auth::user();
            Excel::import(new ProductImport($user), $request->file('import'));
            DB::commit();

            return redirect()->route('admin_page');
        } catch (\Exception $e) {
            DB::commit();
            Log::debug($e);
            abort(400);
        }
    }
    public function getDatatable(Request $request, $user)
    {
        $data = Product::where('user_id', $user->id);
        if ($request->filled('condition')) {
            $data = $data->where("condition", $request->condition);
        }
        $query = $data->get();

        return DataTables::of($query)->editColumn('condition', function ($model) {
            if ($model->condition == 'Baru') {
                return '<div class="rounded px-3 py-1 bg-success w-50 mx-auto text-center">Baru</div>';
            } else {
                return '<div class="rounded px-3 py-1 bg-primary w-50 mx-auto text-center">Bekas</div>';
            }
        })
            ->editColumn('action', function ($model) {
                return '<div class="d-flex">
        <a href="' . route('edit_product', ['product' => $model->id, 'user' => $model->user_id]) . '" class="btn btn-warning btn-md">Update</a>
        <form action="' . route('delete_product', ['product' => $model->id, 'user' => $model->user_id]) . '" method="POST" class="ms-1 ">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button class="btn btn-md btn-danger" type="submit">Delete</button>
        </form>
    </div>';
            })
            ->rawColumns(['condition', 'action'])
            ->addIndexColumn()
            ->make(true);
    }



    public function ExportData(Request $request)
    {
        return Excel::download(new ProductExport($request), 'List Produk.xlsx');
    }
    public function ExportDashboard(Request $request)
    {
        return Excel::download(new DashboardExport($request), 'List Profil_dashboard.xlsx');
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:superadmin,user',
            'gender' => 'required',
            'age' => 'required|integer|min:1',
            'birth' => 'required|date',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
            'birth' => $request->birth,
            'address' => $request->address,

        ]);

        // assign role
        $user->assignRole($request->role);

        if ($user) {
            return redirect()->route('register')
                ->with('success', 'User created successfully');
        } else {
            return redirect()->route('register')
                ->with('error', 'Failed to create user');
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')
                ->with('error', 'Login failed email or password is incorrect');
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function formUser(Request $request, User $user)
    {
        return view('form_add_user');
    }

    public function postUser(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:superadmin,user',
            'gender' => 'required',
            'age' => 'required|integer|min:1',
            'birth' => 'required|date',
            'address' => 'required',
        ]);

        $user->assignRole($request->role);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
            'birth' => $request->birth,
            'address' => $request->address,
        ]);

        return redirect()->route('manage_user');
    }

    public function manageUsers()
    {
        $data = User::all();

        return view('manage_user')->with('users', $data);
    }

    public function edit(User $user)
    {
        return view('edit_user', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->birth = $request->birth;
        $user->address = $request->address;
        $user->save();


        return redirect()->route('manage_user')->with('success', 'Berhasil update data users');
    }

    public function deleteUser(Request $request, User $user)
    {

        $user->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
