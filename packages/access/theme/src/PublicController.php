<?php

namespace Access\Theme;
use Access\Post\Category;
use Illuminate\Support\Facades\Paginator;
use Access\Post\Type;
use Access\Post\Post;
use Access\Page\Page;
use Access\User\Patient;
use Globali\Product\StoreItem;
use Globali\Product\ProductImage;
use Globali\Product\SubCat;
use Globali\Product\Product;
use Globali\Product\Categorization;
use Globali\Booking\Appointment;
use Globali\Booking\PatientLabTest;
use Globali\Orders\Order;
use Globali\Orders\ItemOrder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Cart;


class PublicController extends Controller
{    
    
    public function home()
    {
        return view('themes/'.Get::theme()->name.'/index');
    }

    public function page($slug)
    {
       // if(view()->exists('themes/'.Get::theme()->name.'/'.$slug))
       // {
       //     return view('themes/'.Get::theme()->name.'/'.$slug)
       //         ;
       // }
       // else

        if($page = Page::where('slug',$slug)->first())
        {
            if(view()->exists('themes/'.Get::theme()->name.'/'.$page->template))
            {
                return view('themes/'.Get::theme()->name.'/'.$page->template)

                    ->with('page',$page);
            }
            else
				return view('themes/'.Get::theme()->name.'/page')

				->with('page',$page);
        }
        else
            return abort(404);
    }

    public function categoryNews($category)
    {
        $cat = Category::where('name',$category)->first();
        if(!$cat)
            return abort(404);
        else
            return view('themes/'.Get::theme()->name.'/category_posts')->with('category',$category);
    }


    public function singlePost($slug)
    {
        $post= Post::where('slug',$slug)->first();
        if(!$post)
            return abort(404);
		$post->views +=1;
		$post->save();
        return view('themes/'.Get::theme()->name.'/single_post')->with('post',$post);
    }

    public function search(Request $request){

        $title=$request->key;
        $posts= (!$title)?[]:Post::where('title','LIKE', "%".$title."%")->take(7)->get();
        return view('themes/'.Get::theme()->name.'/search-list')->with('posts',$posts);
    }


    public function find(Request $request)
    {
        $title=$request->key;
        $posts= (!$title)?[]:Post::where('title','LIKE', "%".$title."%")->take(7)->get();

        return view('themes/'.Get::theme()->name.'/search-list')->with('posts',$posts);
    }

    public function itemDetail($id)
    {
        $item_detail = StoreItem::find($id);
        $product_image = ProductImage::where('product_id', $item_detail->item->product->id)->get();
        return view('themes/'.Get::theme()->name.'/details')->with('store_item', $item_detail)->with('images', $product_image);
    }

    public function blogDetail($id)
    {
        $blog_detail = Post::find($id);
        return view('themes/'.Get::theme()->name.'/blog-details')->with('blog_item', $blog_detail);
    }

    public function categoryProduct($id)
    {
        $store_item = StoreItem::whereHas('item',
        function (Builder $query) use($id)
        {
            $query->whereHas('product', function (Builder $query) use($id)
            {
                $query->whereHas('subCat', function (Builder $query) use($id)
                {
                    $query->where('categorization_id', $id);
                });
            });
        })->get();
        return view('themes/'.Get::theme()->name.'/category')->with('store_item', $store_item);
    }

    public function subCatProduct($id)
    {
        $store_item = StoreItem::whereHas('item',
        function (Builder $query) use($id)
        {
            $query->whereHas('product', function (Builder $query) use($id)
            {
                $query->where('sub_cat_id', $id);
            });
        })->get();
        return view('themes/'.Get::theme()->name.'/sub-cat')->with('store_item', $store_item);
    }

    public function patientDashboard()
    {
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        $appointments = Appointment::where('patient_id', $patient->id)->where('status', 'processing')->get();
        $orders = Order::where('patient_id', $patient->id)->where('status', 'processing')->get();
        $labtests = PatientLabTest::where('patient_id', $patient->id)->where('status', 'processing')->get();
        return view('themes/'.Get::theme()->name.'/dashbo')
            ->with('patient', $patient)
            ->with('appointments', $appointments)
            ->with('labtests', $labtests)
            ->with('orders', $orders);
    }

    public function patientProfile()
    {
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        return view('themes/'.Get::theme()->name.'/profile')->with('patient', $patient);
    }

    public function passwordChange()
    {
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        return view('themes/'.Get::theme()->name.'/change-password')->with('patient', $patient);
    }

    // public function myWishList()
    // {
    //     $patient = Patient::where('user_id', auth()->user()->id)->first();
    //     return view('themes/'.Get::theme()->name.'/my-wishlist')->with('patient', $patient);
    // }

    public function myNotification()
    {
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        $appointments = Appointment::where('patient_id', $patient->id)->get();
        $orders = Order::where('patient_id', $patient->id)->get();
        $labtests = PatientLabTest::where('patient_id', $patient->id)->get();
        // dd($appointments);
        return view('themes/'.Get::theme()->name.'/notification')
            ->with('patient', $patient)
            ->with('appointments', $appointments)
            ->with('labtests', $labtests)
            ->with('orders', $orders);
    }
 
    public function myAppointment()
    {
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        $appointments = Appointment::where('patient_id', $patient->id)->get();
        return view('themes/'.Get::theme()->name.'/appointment')->with('patient', $patient)->with('appointments', $appointments);
    }

    public function myOrderStatus()
    {
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        $orders = Order::where('patient_id', $patient->id)->get();
        return view('themes/'.Get::theme()->name.'/order-status')->with('patient', $patient)->with('orders', $orders);
    }

    public function myOrderItem($id)
    {
        $order = Order::find($id);
        $patient = Patient::where('id', $order->patient_id)->first();
        $items = ItemOrder::where('order_id', $id)->get();
        $storeItem = StoreItem::all();
        return view('themes/'.Get::theme()->name.'/order-item')
            ->with('patient', $patient)
            ->with('items', $items)
            ->with('order', $order)
            ->with('storeItem', $storeItem);
    }

    public function myCartGuest()
    {
        $cartContent = Cart::getContent();
        $store_item = [];
        foreach ($cartContent as $item)
        {
            $store_item[] = StoreItem::where('id', $item->id)->first();
        }
        
        return view('themes/'.Get::theme()->name.'/my-cart')->with('store_item', $store_item);
    }

    public function myCartPatient()
    {
        $cartContent = Cart::getContent();
        $store_item = [];
        foreach ($cartContent as $item)
        {
            $store_item[] = StoreItem::where('id', $item->id)->first();
        }
        $patient = Patient::where('user_id', auth()->user()->id)->first();
        return view('themes/'.Get::theme()->name.'/my-cart')->with('patient', $patient)->with('store_item', $store_item);
    }

    public function checkout()
    {
        $cart_content = Cart::getContent();
        $store_item = [];
        foreach ($cart_content as $item)
        {
            $store_item[] = StoreItem::where('id', $item->id)->first();
        }
        if (auth()->user())
        {
            $patient = Patient::where('user_id', auth()->user()->id)->first();
            return view('themes/'.Get::theme()->name.'/checkout')->with('cart_item', $cart_content)->with('store_item', $store_item)->with('patient', $patient);
        }
        return view('themes/'.Get::theme()->name.'/checkout')->with('cart_item', $cart_content)->with('store_item', $store_item);
    }
}
