<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class IndexController extends Controller
{
    public function home()
    {
        $banners = Banner::where(['status' => 'active'])->orderBy('id', 'DESC')->get();
        $categories = Category::where(['status' => 'active', 'is_parent' => 1])->orderBy('id', 'DESC')->get();
        return view('frontend.index', compact(['banners', 'categories']));
    }

    public function productCategory(Request $request, $slug)
    {
        $categories = Category::with(['products'])->where('slug', $slug)->first();
        $sort = '';
        if ($request->sort != null) {
            $sort = $request->sort;
        }
        if ($categories == null) {
            return view('errors.404');
        } else {
            if ($sort == 'priceAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'ASC')->get();
            } else if ($sort == 'priceDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('offer_price', 'DESC')->get();
            } else if ($sort == 'discountAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'ASC')->get();
            } else if ($sort == 'discountDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('price', 'DESC')->get();
            } else if ($sort == 'titleAsc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'ASC')->get();
            } else if ($sort == 'titleDesc') {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->orderBy('title', 'DESC')->get();
            } else {
                $products = Product::where(['status' => 'active', 'cat_id' => $categories->id])->get();
            }
        }

        $route = 'product-category';

        if ($request->ajax()) {
            $view = view('frontend.layouts._single-product', compact('products'))->render();
            return response()->json(['html' => $view]);
        }
        return view('frontend.pages.product.product-category', compact(['categories', 'route', 'products']));
    }

    public function productDetail($slug)
    {
        $product = Product::with('rel_prods')->where('slug', $slug)->first();
        if ($product) {
            return view('frontend.pages.product.product-detail', compact('product'));
        } else {
            return 'Product detail not found';
        }
    }

    public function userAuth()
    {
        Session::put('url.intended', URL::previous());
        return view('frontend.auth.auth');
    }

    public function loginSubmit(Request $request)
    {
        $this->validate($request, [
            'email' => 'email|required|exists:users,email',
            'password' => 'required|min:4'
        ]);
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 'active'])) {
            Session::put('user', $request->email);

            if (Session::get('url.intended')) {
                return Redirect::to(Session::get('url.intended'));
            } else {
                return redirect()->route('home')->with('success', 'Successfully login');
            }
        } else {
            return back()->with('error', 'Invalid email & password!');
        }
    }

    public function registerSubmit(Request $request)
    {
        $this->validate($request, [
            'username' => 'nullable|string',
            'full_name' => 'required|string',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|min:4|confirmed',
        ]);

        $data = $request->all();
        $check = $this->create($data);
        Session::put('user', $data['email']);
        Auth::login($check);
        if ($check) {
            return redirect()->route('home')->with('success', 'Success register');
        } else {
            return back()->with('error', 'Please check your credentials');
        }
    }

    private function create(array $data)
    {
        return User::create([
            'full_name' => $data['full_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function userLogout()
    {
        Session::forget('user');
        Auth::logout();
        return redirect()->home()->with('success', 'Successfully logout');
    }

    public function userDashboard()
    {
        $user=Auth::user();
        return view('frontend.user.dashboard', compact('user'));
    }

    public function userOrder()
    {
        $user=Auth::user();
        return view('frontend.user.order', compact('user'));
    }

    public function userAccount()
    {
        $user=Auth::user();
        return view('frontend.user.account', compact('user'));
    }

    public function updateAccount(Request $request, $id)
    {
        $this->validate($request, [
            'newpassword' => 'password|min:4',
            'oldpassword' => 'password|min:4',
            'full_name' => 'required|string',
            'username' => 'required|string',
            'phone'=>'nullable|max:12'
        ]);

        $hashpassword = Auth::user()->password;
        if($request->oldPassword == null && $request->newPassword == null){
            User::where('id', $id)->update(['full_name'=>$request->full_name, 'username'=>$request->username, 'phone'=>$request->phone]);
            return back()->with('success', 'Account successfully updated');
        } else {
            if(Hash::check($request->oldPassword, $hashpassword)){
                if(!Hash::check($request->newPassword, $hashpassword)){
                    User::where('id', $id)->update(['full_name'=>$request->full_name, 'username'=>$request->username, 'phone'=>$request->phone, 'password' => Hash::make($request->newPassword)]);
                    return back()->with('success', 'Account successfully updated');
                } else {
                    return back()->with('error', 'New password can not be same with old passord');
                }
            } else {
                return back()->with('error', 'Old password does not math');
            }
        }
    }
}
