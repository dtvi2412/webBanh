<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\Customer;
use App\Bill;
use App\BillDetail;
use App\User;
use Hash;
use Auth;
use Carbon\Carbon;
use App\Product_image;
class PageController extends Controller
{
    public function getIndex(){
        $slide = Slide::where('status',1)->get();
        // print_r($slide);
        // exit;
        //code cu 
        //$new_product = Product::where('new',1)->paginate(4);
        $new_product = Product::where([
                                ['new','=','1'],
                                ['unit','=','1'],
                                ])->orderBy('id','desc')->paginate(6);
        //$new_product = Product::where('unit',1)->paginate(4);
        // dd($new_product);
        //code cu
        //$sanpham_khuyenmai = Product::where('promotion_price','<>',0)->paginate(8);
        $sanpham_khuyenmai = Product::where([
                                            ['promotion_price','<>','0'],
                                            ['unit','=','1'],
                                            ])->orderBy('promotion_price','asc')->paginate(8);
       // $sanpham_khuyenmai = Product::where('unit',1)->paginate(4);
        // $sanpham_banchay = DB::table('products')
        //                     ->join('bill_detail','products.id','=','bill_detail.id_product')
        //                     ->select('products.*','bill_detail.quantity')
        //                     ->get();

        $sanpham_banchay = BillDetail::select('id_product')
                                ->groupBy('id_product')
                                ->havingRaw('SUM(quantity) > ?',[5])
                                ->get();
        

    	return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai','sanpham_banchay'));
    }
    // public function fetch_data(Request $request){
    //     if($request->ajax()){
    //         $new_product = Product::where([
    //                             ['new','=','1'],
    //                             ['unit','=','1'],
    //                             ])->orderBy('id','desc')->paginate(4);
    //         return view('page.trangchu',compact('new_product'))->render();
    //     }
    // }

    public function getLoaiSp($type){
        //$sp_theoloai = Product::where('id_type',$type)->get();
        //code cu
        //$sp_theoloai = Product::where('id_type',$type)->paginate(6);
        $sp_theoloai = Product::where([
                                    ['id_type',$type],
                                    ['unit','=','1'],
                                    ])->get();
        //code cu
        //$sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $sp_khac = Product::where([
                                ['id_type','<>',$type],
                                ['unit','=','1'],
                                ])->paginate(4);
        
        $loai = ProductType::where('description',1)->get();
        //code cu
        //$loai_sp = ProductType::where('id',$type)->first();
        $loai_sp = ProductType::where([
                                    ['id',$type],
                                    ['description','=','1'],
                                    ])->first();

    	return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));

    }
    public function getLoaiSanPhamAjax($type){

        $sp_theoloai = Product::where([
                                    ['id_type',$type],
                                    ['unit','=','1'],
                                    ])->get();
        //code cu
        //$sp_khac = Product::where('id_type','<>',$type)->paginate(3);
        $sp_khac = Product::where([
                                ['id_type','<>',$type],
                                ['unit','=','1'],
                                ])->paginate(4);
        
        $loai = ProductType::where('description',1)->get();
        //code cu
        //$loai_sp = ProductType::where('id',$type)->first();
        $loai_sp = ProductType::where([
                                    ['id',$type],
                                    ['description','=','1'],
                                    ])->first();

        

        return view('page.loaisanphamAjax',compact('sp_theoloai','sp_khac','loai','loai_sp'))->render();

    }

    public function getChitiet(Request $req){

        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);

        $hinhlienquan = Product_image::where('id_product',$req->id)->get();
    	return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','hinhlienquan'));
    }
    public function getAjaxSPTuongTu(Request $req){
        $sanpham = Product::where('id',$req->id)->first();
        $sp_tuongtu = Product::where('id_type',$sanpham->id_type)->paginate(3);

        return view('page.chitiet_sanpham_ajax',compact('sanpham','sp_tuongtu'))->render();

    }

    public function getLienHe(){
    	return view('page.lienhe');
    }
    public function getGioiThieu(){
    	return view('page.gioithieu');
    }
    public function getAddtoCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{
            Session::forget('cart');
        }
        

        return redirect()->back();
    }
    public function getCheckout(){

        return view('page.dat_hang');
    }
    public function postCheckout(Request $req){
        $this->validate($req,
                        [
                            'name'=>'required|min:1|max:100',
                            'email'=>'required|email|min:6|max:24',
                            'address'=>'required|min:3|max:100',
                            'phone'=>'required|min:3|max:15'
                        ],
                        [
                            'name.required' => 'Vui lòng nhập tên',
                            'name.min' => 'Sorry!!Tên bạn ít nhất là 1 ký tự',
                            'name.max' => 'Soory!!Tên bạn không được nhập quá 100 ký tự',
                            'email.required' => 'Bạn chưa nhập email',
                            'email.email' => 'Bạn cần nhập đúng định dạng email',
                            'email.min' => 'Email của bạn ít nhất phải 6 ký tự ',
                            'email.max' => 'Email của bạn không được quá 24 ký tự',
                            'address.required' => 'Bạn cần nhập địa chỉ để nhân viên giao hàng',
                            'address.min' => 'Địa chỉ ít nhất 3 kí tự',
                            'address.max' => 'Địa chỉ không được quá 100 ký tự',
                            'phone.required' => 'Bạn vui lòng nhập số điện thoại',
                            'phone.min.' => 'Số điện thoại phải có ít nhất 3 số',
                            'phone.max' => 'Số điện thoại không được quá 15 số'
                        ],
                            );

        $cart = Session::get('cart');
        

        $customer = new Customer;
        $customer->name = $req->name;
        $customer->gender = $req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number = $req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment_method;
        $bill->note = $req->notes;
        $bill->status = 0;
        $bill->save();

        foreach ($cart->items as $key => $value) {  
            $bill_detail = new BillDetail;
            $bill_detail->id_bill = $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity =$value['qty'];
            $bill_detail->unit_price = ($value['price']/$value['qty']);
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Bạn đã đặt hàng thành công');


    }
    public function getLogin(){
        return view('page.dangnhap');
    }
    public function getSignin(){
        return view('page.dangki');
    }
    public function postSignin(Request $req){
        $this->validate($req,

            [
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:6|max:20',
                'fullname'=>'required',
                're_password'=>'required|same:password'
            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Không đúng định dạng email',
                'email.unique'=>'Email đã có người sử dụng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự'
            ]);
        $user = new User();
        $user->full_name = $req->fullname;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->quyen = 0;
        $user->trangthai = 1;
        $user->phone = $req->phone;
        $user->address = $req->address;
        $user->save(); 
        return redirect()->back()->with('thanhcong','Chúc mừng bạn đã tạo tài khoản thành công');
    }
    public function postLogin(Request $req){
        $this->validate($req,
            [
                'email'=>'required|email',
                'password'=>'required|min:6|max:20'

            ],
            [
                'email.required'=>'Vui lòng nhập email',
                'email.email'=>'Email không đúng định dạng',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu tối đa 20 kí tự'

            ]
        );
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials) && Auth::user()->trangthai==1){
            // $user = new User();
            if(Auth::user()->quyen == 1){
            //return redirect()->route('trang-chu');
            return redirect('admin/theloai/danhsach');
            }
            else{
                return redirect()->route('trang-chu');
            }
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập không thành công']);
        }

    }
    public function getLogout(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    public function getSearch(Request $req){
        //code cu
        //$product = Product::where('name','like','%'.$req->key.'%')
        $tu_khoa = $req->key;
        $product = Product::where([
                            ['name','like','%'.$req->key.'%'],
                            ['unit','=','1'],
                            ])
                            ->orWhere('unit_price',$req->key)
                            //->orWhere('promotion_price',$req->key)
                            ->orWhere([
                                        ['description','like','%'.$req->key.'%'],
                                        ['unit',1],
                                        ])
                            ->paginate(15);
        return view('page.search',compact('product','tu_khoa'));

    }
    public function getAjaxSearch(Request $req){
        $tu_khoa = $req->key;
        $product = Product::where([
                            ['name','like','%'.$req->key.'%'],
                            ['unit','=','1'],
                            ])
                            ->orWhere('unit_price',$req->key)
                            //->orWhere('promotion_price',$req->key)
                            ->orWhere([
                                        ['description','like','%'.$req->key.'%'],
                                        ['unit',1],
                                        ])
                            ->paginate(15);
        return view('page.search_ajax',compact('product','tu_khoa'))->render();

    }
    public function getSapXeptangTheoTen(){
        //code cu
        //$sapxep_theoten = Product::orderBy('name','asc')->paginate(3);
        // $gia = Product::all();
        // if(($gia->promotion_price) != 0){
        //     $sapxep_theogia = Product::where('unit',1)
        //                         ->orderBy('promotion_price','asc')
        //                         ->paginate(3);
        // }
        // else{
        //     $sapxep_theogia = Product::where('unit',1)
        //                         ->orderBy('unit_price','asc')
        //                         ->paginate(3);
        // }
        $sapxep_theoten = Product::where('unit',1)
                                ->orderBy('name','asc')->paginate(3);


        return view('page.sap_xep',compact('sapxep_theoten'));
    }
    public function gettangTenAjax(){
        $sapxep_theoten = Product::where('unit',1)
                                ->orderBy('name','asc')->paginate(3);


        return view('page.sapxeptentang_ajax',compact('sapxep_theoten'))->render();
    }
    public function getSapXepgiamTheoTen(){
        $sapxep_theoten = Product::where('unit',1)
                                ->orderBy('name','desc')->paginate(3);

        return view('page.sap_xep_giam',compact('sapxep_theoten'));
    }
    public function getgiamTenAjax(){
        $sapxep_theoten = Product::where('unit',1)
                                ->orderBy('name','desc')->paginate(3);

        return view('page.sapxeptengiam_ajax',compact('sapxep_theoten'))->render();
    }

    public function getSapXeptanggia(){

        //$gia = Product::where('unit',1)->first();
       
        // if(($gia->promotion_price) ==1){
        //     $sapxep_theogia = Product::where('unit',1)
        //                         ->orderBy('promotion_price','asc')
        //                         ->paginate(3);
        // }
        // else{
        //     $sapxep_theogia = Product::where('unit',1)
        //                         ->orWhere('unit_price','asc')
        //                         ->paginate(3);
        // }
        //if($gia->promotion_price > 0){
        $sapxep_theogia = Product::where('unit',1)
                                        ->orderBy('unit_price','asc')
                                        ->paginate(3);
        //}
                            
        return view('page.sap_xep_theo_gia_tang',compact('sapxep_theogia'));

    }
    public function gettangGiaAjax(){
         $sapxep_theogia = Product::where('unit',1)
                                        ->orderBy('unit_price','asc')
                                        ->paginate(3);
        
                            
        return view('page.sapxepgiatang_ajax',compact('sapxep_theogia'))->render();

    }


    public function getSapXepgiamgia(){

        $sapxep_theogia = Product::where('unit',1)
                                ->orderBy('unit_price','desc')
                                ->paginate(3);
        return view('page.sap_xep_theo_gia_giam',compact('sapxep_theogia'));

    }
    public function getgiamGiaAjax(){
        $sapxep_theogia = Product::where('unit',1)
                                ->orderBy('unit_price','desc')
                                ->paginate(3);
        return view('page.sapxepgiagiam_ajax',compact('sapxep_theogia'))->render();

    }


    //ADMIN THEM XOA SUA DANH SACH THE LOAI
    public function getDanhSach(){
        $theloai = ProductType::where('description',1)->get();
        return view('admin.theloai.danhsach',compact('theloai'));
    }
    public function getThem(){
        return view('admin.theloai.them');

    }
    public function postThem(Request $request){
        $this->validate($request,
            [
                'Ten' => 'required|min:3|max:100|unique:type_products,name'
                //'mieuta' => 'required|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự', 
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3 đến 100 kí tự', 

                //'mieuta.required'=>'Bạn chưa nhập thông tin miêu tả',
               // 'mieuta.min'=>'Miêu tả phải có độ dài từ 3 đến 100 kí tự', 
                //'mieuta.max'=>'Miêu tả phải có độ dài từ 3 đến 100 kí tự', 
                'Ten.unique'=>'Tên thể loại đã tồn tại'
            ]);
        $theloai = new ProductType;
        $theloai->name = $request->Ten;
        $theloai->description = 1;
        $theloai->image = "0";
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }
    public function getSua($id){
        $theloai = ProductType::find($id);
        return view('admin.theloai.sua',compact('theloai'));
    }
    public function postSua(Request $request,$id){
        $theloai = ProductType::find($id);
        $this->validate($request,
            [
                'Ten' =>'required|unique:type_products,name|min:3|max:100'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên thể loại',
                'Ten.unique'=>'Tên thể loại đã tồn tại',
                'Ten.min'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 kí tự',
                'Ten.max'=>'Tên thể loại phải có độ dài từ 3 cho đến 100 kí tự'
            ]
            );
        $theloai->name = $request->Ten;
        $theloai->save();

        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoa($id){
        $theloai = ProductType::find($id);
        $sanpham = Product::where('id_type',$id)->get();
        $theloai->description = 0;
        foreach ($sanpham as  $value) {
            $value->unit = 0;
            $value->save();
        }

        $theloai->save();

        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
    //ADMIN THEM XOA SUA SAN PHAM
    public function getDanhSachSP(){
        $sanpham = Product::where('unit',1)->get();


        return view('admin.sanpham.danhsach',compact('sanpham'));
    }
    public function getDanhSachSPMoi(){
        $sanpham_moi = Product::where([
                                ['new','=','1'],
                                ['unit','=','1'],
                                ])->get();
        return view('admin.sanpham.danhsachmoi',compact('sanpham_moi'));
    }
    public function getDanhSachSPKM(){
        $sanpham_khuyenmai = Product::where([
                                            ['promotion_price','<>','0'],
                                            ['unit','=','1'],
                                            ])->get();
        return view('admin.sanpham.danhsanhkhuyenmai',compact('sanpham_khuyenmai'));
    }
    public function getDanhSachSPBanChay(){
        $sanpham_banchay = BillDetail::select('id_product')
                                ->groupBy('id_product')
                                ->havingRaw('SUM(quantity) > ?',[5])
                                ->get();
        return view('admin.sanpham.danhsachbanchay',compact('sanpham_banchay'));
    }
    public function getSuaSP($id){
        $theloai = ProductType::all();
        $sanpham = Product::find($id);

        return view('admin.sanpham.sua',compact('sanpham','theloai'));
    }
    public function postSuaSP(Request $request,$id){
        $sanpham = Product::find($id);
        $this->validate($request,
            [
                'Ten'=>'required|min:3|unique:products,name,'.$id.'id',
                'ChiTiet'=>'required',
                'Gia'=>'required',
                'GiaKhuyenMai'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên sản phẩm',
                'Ten.min'=>'Tên phải có ít nhất 3 kí tự',
                'Ten.unique'=>'Tên đã tồn tại',
                'ChiTiet.required'=>'Bạn chưa nhập chi tiết sản phẩm',
                'Gia.required'=>'Bạn chưa nhập giá',
                'GiaKhuyenMai.required'=>'Bạn chưa nhập giá khuyến mãi'
            ]
            );
        $sanpham->name = $request->Ten;
        $sanpham->id_type =$request->TheLoai;
        $sanpham->description =$request->ChiTiet;
        $sanpham->unit_price = $request->Gia;
        $sanpham->promotion_price = $request->GiaKhuyenMai;
        if($sanpham->promotion_price >= $sanpham->unit_price){
            return redirect('admin/sanpham/sua/'.$id)->with('nhapsai','Sorry!!Bạn không được nhập giá khuyễn mãi nhỏ hơn hoặc bằng giá gốc');
        }

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png'&& $duoi != 'jpeg'){
                return redirect('admin/sanpham/sua/'.$id)->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();

            $Hinh = str_random(4)."_". $name;
            //Kiem tra hinh ton tai chua , ton tai se random tiep
            while(file_exists("HinhBanh/".$Hinh)){

                $Hinh = str_random(4)."_". $name;
            }
            //luuHinh vao duong dan
            $file->move("HinhBanh/",$Hinh);
            //luu hinh moi
            //unlink("HinhBanh/".$sanpham->image);
            $sanpham->image = $Hinh;
        }
        $sanpham->unit = 1;
        $sanpham->new = $request->Moi;
        
        $sanpham->save();

        return redirect('admin/sanpham/sua/'.$id)->with('thongbao','Sửa thành công');


    }
    public function getThemSP(){
        $theloai = ProductType::all();
       
        return view('admin.sanpham.them',compact('theloai'));
    }
    public function postThemSP(Request $request){
        $this->validate($request,
            [
                'Ten'=>'required|min:3|unique:products,name',
                'ChiTiet'=>'required',
                'Gia'=>'required',
                'GiaKhuyenMai'=>'required'
            ],
            [
                'Ten.required'=>'Bạn chưa nhập tên sản phẩm',
                'Ten.min'=>'Tên phải có ít nhất 3 kí tự',
                'Ten.unique'=>'Tên đã tồn tại',
                'ChiTiet.required'=>'Bạn chưa nhập chi tiết sản phẩm',
                'Gia.required'=>'Bạn chưa nhập giá',
                'GiaKhuyenMai.required'=>'Bạn chưa nhập giá khuyến mãi'
            ]
            );
        $sanpham = new Product;
        $sanpham->name = $request->Ten;
        $sanpham->id_type =$request->TheLoai;
        $sanpham->description =$request->ChiTiet;
        $sanpham->unit_price = $request->Gia;
        $sanpham->promotion_price = $request->GiaKhuyenMai;
        if($sanpham->promotion_price >= $sanpham->unit_price){
            return redirect('admin/sanpham/them')->with('nhapsai','Sorry!!Bạn không được nhập giá khuyễn mãi nhỏ hơn hoặc bằng giá gốc');
        }

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png'&& $duoi != 'jpeg'){
                return redirect('admin/sanpham/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();

            $Hinh = str_random(4)."_". $name;
            //Kiem tra hinh ton tai chua , ton tai se random tiep
            while(file_exists("HinhBanh/".$Hinh)){

                $Hinh = str_random(4)."_". $name;
            }
            //luuHinh vao duong dan
            $file->move("HinhBanh/",$Hinh);
            $sanpham->image = $Hinh;
        }
        else{
            $sanpham->image = "";
        }
        $sanpham->unit = 1;
        $sanpham->new = $request->Moi;
        
        $sanpham->save();

        return redirect('admin/sanpham/them')->with('thongbao','Bạn đã thêm sản phẩm thành công');
    }

    public function getThemNhieuHinhSP(){
        $product = Product::all();

        return view('admin/sanpham/themnhieuhinh',compact('product'));
    }
    public function postThemNhieuHinhSP(Request $request){

        $this->validate($request,
                        [
                            'Hinh' => 'required',
                        ],
                        [
                            'Hinh.required' => 'Bạn chưa nhập hình'
                        ]
                        );

        $product_image = new Product_image;

        $product_image->id_product = $request->TenSP;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png'&& $duoi != 'jpeg'){
                return redirect('admin/sanpham/themnhieuhinh')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();

            $Hinh = str_random(4)."_". $name;
            //Kiem tra hinh ton tai chua , ton tai se random tiep
            while(file_exists("nhieuhinh/".$Hinh)){

                $Hinh = str_random(4)."_". $name;
            }
            //luuHinh vao duong dan
            $file->move("nhieuhinh/",$Hinh);
            $product_image->image = $Hinh;
        }
        else{
            $product_image->image = "";
        }

        $product_image->save();

        return redirect('admin/sanpham/themnhieuhinh')->with('thongbao','Bạn đã thêm hình vào sản phẩm thành công');
    }



    public function getXoaSP($id){
        $sanpham = Product::find($id);
        $sanpham->unit = 0;
        $sanpham->save();

        return redirect('admin/sanpham/danhsach')->with('thongbao','Xóa thành công');
    }
    //ADMIN THEM XOA SUA SLIDE
    public function getDanhSachSL(){
        $slide = Slide::where('status',1)->get();
        return view('admin.slide.danhsach',compact('slide'));
    }
    public function getThemSL(){

        return view('admin/slide/them');
    }
    public function getXoaSL($id){
        $slide = Slide::find($id);
        $slide->status = 0;
        $slide->save(); 
        return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');
    }
    public function postThemSL(Request $request){
        $this->validate($request,[
                'Ten'=>'required|min:3|max:100',
                'link'=>'required'
                ],
                [
                'Ten.required'=>'Bạn chưa nhập tên',
                'Ten.min'=>'Tên slide ít nhất từ 3 đến 100 kí tự',
                'Ten.max'=>'Tên slide ít nhất từ 3 đến 100 kí tự',
                'link.required'=>'Bạn chưa nhập link'
                ]
            );
        $slide = new Slide;
        $slide->name =$request->Ten;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png'&& $duoi != 'jpeg'){
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();

            $Hinh = str_random(4)."_". $name;
            //Kiem tra hinh ton tai chua , ton tai se random tiep
            while(file_exists("hinhSlide/".$Hinh)){

                $Hinh = str_random(4)."_". $name;
            }
            //luuHinh vao duong dan
            $file->move("hinhSlide",$Hinh);
            $slide->image = $Hinh;
        }
        else{
            $slide->image = "";
        }

        if($request->has('link'))
            $slide->link = $request->link;
        
        $slide->status = 1;

        $slide->save();

        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }

    public function getSuaSL($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',compact('slide'));
    }
    public function postSuaSL(Request $request,$id){
        $this->validate($request,[
                'Ten'=>'required|min:3|max:100',
                'link'=>'required'
                ],
                [
                'Ten.required'=>'Bạn chưa nhập tên',
                'Ten.min'=>'Tên slide ít nhất từ 3 đến 100 kí tự',
                'Ten.max'=>'Tên slide ít nhất từ 3 đến 100 kí tự',
                'link.required'=>'Bạn chưa nhập link'
                ]
            );
        $slide = Slide::find($id);
        $slide->name =$request->Ten;

        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi !='png'&& $duoi != 'jpeg'){
                return redirect('admin/slide/them')->with('loi','Bạn chỉ được chọn file có đuôi jpg,png,jpeg');
            }
            $name = $file->getClientOriginalName();

            $Hinh = str_random(4)."_". $name;
            //Kiem tra hinh ton tai chua , ton tai se random tiep
            while(file_exists("hinhSlide/".$Hinh)){

                $Hinh = str_random(4)."_". $name;
            }
            //luuHinh vao duong dan
            $file->move("hinhSlide",$Hinh);
            $slide->image = $Hinh;
        }
        

        if($request->has('link'))
            $slide->link = $request->link;
        
        $slide->status = 1;

        $slide->save();

        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    //ADMIN DANH SACH HOA DON
    public function getDanhSachBill(){
        $bill = Bill::all();
        $carbon_ngay = Carbon::now()->day;
        $carbon_thang = Carbon::now()->month;
        $carbon_nam = Carbon::now()->year;
        $carbon_allngaytrongthang = Carbon::now()->daysInMonth;

        //$tongtien_trongngay = Bill::where('date_order',$carbon_nam.'-0'.$carbon_thang.'-'.$carbon_ngay)->sum('total');
        $tongtien_trongngay = Bill::where([
                                            ['date_order',$carbon_nam.'-0'.$carbon_thang.'-'.$carbon_ngay],
                                            ['status',2],
                                            ])->sum('total');
        //$tongtien_trongthang = Bill::where('date_order','2019-0'.$carbon_thang.'-0'.$carbon_allngaytrongthang)->sum('total');
        // $timestamp = strtotime($bill->updated_at);
        // $month = date('m',$timestamp);

        // $tongtien_trongthang = Bill::whereMonth('updated_at',format('m'))
        //                             ->where('updated_at',$carbon_thang)
        //                             ->sum('total');

        $tongtien_trongthang = Bill::whereMonth('date_order',date('m'))
                                    ->where('date_order','0'.$carbon_thang)
                                    ->sum('total');
        return view('admin/bill/danhsach',compact('bill','tongtien_trongngay','carbon_ngay','carbon_thang','tongtien_trongthang'));
    }
    public function getDuyetDanhSachBill($id){
        $bill = Bill::find($id);
        if($bill->status == 0){
            $bill->status = 1;
        }
        else if($bill->status == 1){
            $bill->status = 2;
        }

        $bill->save();
        return redirect()->back()->with('thongbao','Bạn đã duyệt đơn hàng thành công');
    }
    public function getXemChiTietBill($id){
        $bill = Bill::find($id);
        // $bill_dt = BillDetail::select('id_product')
        //                     ->groupBy('id_product')
        //                     ->havingRaw('SUM(quantity) = ?',$id)
        //                     ->get();
        // $sanpham_banchay = BillDetail::select('id_product')
        //                         ->groupBy('id_product')
        //                         ->havingRaw('SUM(quantity) > ?',[5])
        //                         ->get();
        $bill_detail = BillDetail::where('id_bill',$id)->get();
        return view('admin/bill/xemchitiet',compact('bill','bill_detail'));
    }
    public function getDanhSachBillChuaDuyet(){
        $bill = Bill::where('status',0)->get();

        return view('admin/bill/danhsachchuaduyet',compact('bill'));
    }
    public function getDuyetDanhSachBillChuaDuyet($id){
        $bill = Bill::find($id);
        $bill->status = 1;
        $bill->save();
        return redirect()->back()->with('thongbao','Bạn đã duyệt đơn hàng thành công');
    }
    public function getDanhSachBillDangGiao(){
        $bill = Bill::where('status',1)->get();

        return view('admin/bill/danhsachdanggiao',compact('bill'));
    }
    public function getDuyetDanhSachBillDangGiao($id){
        $bill = Bill::find($id);
        $bill->status = 2;
        $bill->save();
        return redirect()->back()->with('thongbao','Bạn đã duyệt đơn hàng thành công');
    }
    public function getDanhSachBillDaGiao(){
        $bill = Bill::where('status',2)->get();

        return view('admin/bill/danhsachdagiao',compact('bill'));
    }
    public function getXoaDanhSachBill($id){
        $bill = Bill::find($id);
        $bill->status = 3;

        $bill->save();
        return redirect()->back()->with('thongbao','Bạn đã xóa đơn hàng thành công');
    }
    public function getDanhSachDaXoa(){
        $bill = Bill::where('status',3)->get();

        return view('admin/bill/danhsachdaxoa',compact('bill'));
    }
    //ADMIN THEM XOA SUA USER
    public function getDanhSachUS(){
        //$user = User::all();

        $user = User::where('trangthai',1)->get();
        return view('admin.user.danhsach',compact('user'));
    }
    public function getThemUS(){
        return view('admin.user.them');
    }
    public function postThemUS(Request $request){
        $this->validate($request,[
                'name'=>'required|min:3',
                'email'=>'required|email|unique:users,email',
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password',
                'phone' =>'required',
                'diachi' =>'required'
                ],
                [
                    'name.required'=>'Bạn chưa nhập tên người dùng',
                    'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
                    'email.required'=>'Bạn chưa nhập email',
                    'email.email'=>'Bạn chưa nhập đúng định dạng email',
                    'email.unique'=>'Email đã tồn tại',
                    'password.required'=>'Bạn chưa nhập mật khẩu',
                    'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
                    'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
                    'passwordAgain.required'=>'Ban chưa nhập lại mật khẩu',
                    'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng',
                    'phone.required'=>'Bạn chưa nhập số điện thoai',
                    'diachi.required'=>'Bạn chưa nhập địa chỉ'

                ]
            );
        $user = new User;
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->phone = $request->phone;
        $user->address =$request->diachi;

        $user->quyen = $request->quyen;
        $user->trangthai = 1;

        $user->save();

        return redirect('admin/user/them')->with('thongbao','Thêm thành công');
        
        

    }
    public function getSuaUS($id){
        $user = User::find($id);
        return view('admin/user/sua',compact('user'));
    }
    public function postSuaUS(Request $request,$id){

        $this->validate($request,[
                'name'=>'required|min:3',
                'phone' =>'required',
                'diachi' =>'required'
                ],
                [
                    'name.required'=>'Bạn chưa nhập tên người dùng',
                    'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
                    'phone.required'=>'Bạn chưa nhập số điện thoai',
                    'diachi.required'=>'Bạn chưa nhập địa chỉ'

                ]
            );
        $user = User::find($id);
        $user->full_name = $request->name;
        
        $user->phone = $request->phone;
        $user->address =$request->diachi;

        $user->quyen = $request->quyen;
        $user->trangthai = 1;

        
        if($request->changePassword == "on"){
            $this->validate($request,[
                    'password'=>'required|min:3|max:32',
                    'passwordAgain'=>'required|same:password'
                ],
                [
                    'password.required'=>'Bạn chưa nhập mật khẩu',
                    'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
                    'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
                    'passwordAgain.required'=>'Ban chưa nhập lại mật khẩu',
                    'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng'
                ]
            );
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }
    public function getXoaUS($id){
        $user = User::find($id);
        $user->trangthai = 0;

        $user->save();

        return redirect('admin/user/danhsach')->with('thongbao','Xóa người dùng thành công');
    }


    //Nguoi dung
    public function getNguoiDung(){
        $user = Auth::user();

        if(Auth::check())
        {
            return view('page.nguoidung',compact('user'));
        }
        else{
            return view('page.dangnhap')->with('message','Bạn chưa đăng nhập');
        } 
    }
    public function postNguoiDung(Request $request){

        $this->validate($request,[
                'name'=>'required|min:3',
                'phone' =>'required',
                'diachi' =>'required'
                ],
                [
                    'name.required'=>'Bạn chưa nhập tên người dùng',
                    'name.min'=>'Tên người dùng phải có ít nhất 3 kí tự',
                    'phone.required'=>'Bạn chưa nhập số điện thoai',
                    'diachi.required'=>'Bạn chưa nhập địa chỉ'

                ]
            );
        $user = Auth::user();
        $user->full_name = $request->name;
        
        $user->phone = $request->phone;
        $user->address =$request->diachi;

        $user->trangthai = 1;

        
        if($request->changePassword == "on"){
            $this->validate($request,[
                    'password'=>'required|min:3|max:32',
                    'passwordAgain'=>'required|same:password'
                ],
                [
                    'password.required'=>'Bạn chưa nhập mật khẩu',
                    'password.min'=>'Mật khẩu phải có ít nhất 3 kí tự',
                    'password.max'=>'Mật khẩu chỉ được tối đa 32 kí tự',
                    'passwordAgain.required'=>'Ban chưa nhập lại mật khẩu',
                    'passwordAgain.same'=>'Mật khẩu nhập lại chưa đúng'
                ]
            );
            if(Auth::user()->password == bcrypt($request->password)){
                return redirect('nguoidung')->with('message','Mật khẩu không được trùng với mật khẩu hiện tại');
            }
            else{
            $user->password = bcrypt($request->password);
            }
        }
        $user->save();
        return redirect('nguoidung')->with('thongbao','Sửa thành công');

    }

    public function getDanhSachDoanhThu(){

        $danhsachdoanhthu = Bill::where('status',2)->get();
        $tongtien = Bill::where('status',2)->sum('total');

        return view('admin.doanhthu.danhsach',compact('danhsachdoanhthu','tongtien'));
    }
    public function getDanhSachCacNgay(Request $req){
        //$doanhthu = Bill::where('date_order',$req->date_order)->get();

        $doanhthu = Bill::where([
                                ['date_order',$req->date_order],
                                ['status',2],
                                ])->get();

        $tongdoanhthu = Bill::where([
                                    ['date_order',$req->date_order],
                                    ['status',2],
                                    ])->sum('total');
        $tongdoanhthucuathang = Bill::where([
                                            ['date_order','like','%'.$req->thang.'%'],
                                            ['status',2],
                                            ])->get();

        

        // $carbon_ngay = Carbon::now()->day;
        // $carbon_thang = Carbon::now()->month;
        // $carbon_nam = Carbon::now()->year;
        $carbon_now = Carbon::now();

        //$carbon_now->toDateString();//Lay ngay thang nam hien tai ko lay time

        // $carbon_now->toDateString();

        // $tongtien_trongngay = Bill::where([
        //                                     ['date_order',$carbon_nam.'-0'.$carbon_thang.'-'.$carbon_ngay],
        //                                     ['status',2],
        //                                     ])->sum('total');

        return view('admin.doanhthu.danhsachcacngay',compact('doanhthu','tongdoanhthu','carbon_now'));
    }
    public function getDanhSachCacThang(Request $req){

        $tongdoanhthucuathang = Bill::where([
                                            ['date_order','like','%'.$req->thang.'%'],
                                            ['status',2],
                                            ])->get();
        $tongdoanhthu = Bill::where([
                                    ['date_order','like','%'.$req->thang.'%'],
                                    ['status',2],
                                    ])->sum('total');

         return view('admin.doanhthu.danhsachcacthang',compact('tongdoanhthucuathang','tongdoanhthu'));

    }

}
