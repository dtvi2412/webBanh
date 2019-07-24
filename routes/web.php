<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Product;

Route::get('/', function () {
    return view('welcome');
});
Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);
// Route::get('index/fetch_data',[
// 	'as'=>'trang-chu',
// 	'uses'=>'PageController@fetch_data'
// ]);
Route::get('/ajax/products',function(){
	$new_product = Product::where([
                                ['new','=','1'],
                                ['unit','=','1'],
                                ])->orderBy('id','desc')->paginate(6);

	return view('page.product',compact('new_product'))->render();
});
Route::get('/ajax/products_sale',function(){
	$sanpham_khuyenmai = Product::where([
                                        ['promotion_price','<>','0'],
                                        ['unit','=','1'],
                                        ])->orderBy('promotion_price','asc')->paginate(8);

	return view('page.product_sale',compact('sanpham_khuyenmai'))->render();
});


Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);
Route::get('/ajax/loaisanphamAjax/{type}','PageController@getLoaiSanPhamAjax');

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);
Route::get('/ajax/chitiet_sanpham_ajax/{id}','PageController@getAjaxSPTuongTu');

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);
Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);
Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);
Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);
Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@getCheckout'
]);
Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'PageController@postCheckout'
]);
Route::get('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@getLogin'
]);
Route::post('dang-nhap',[
	'as'=>'login',
	'uses'=>'PageController@postLogin'
]);
Route::get('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@getSignin'
]);
Route::post('dang-ki',[
	'as'=>'signin',
	'uses'=>'PageController@postSignin'
]);
Route::get('dang-xuat',[
	'as'=>'logout',
	'uses'=>'PageController@getLogout'
]);
Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);
Route::get('/ajax/search_ajax','PageController@getAjaxSearch');
//SAP SEP SAN PHAM
//THEO TEN
Route::get('sap-xep-tang-ten',[
	'as'=>'sapxeptangten',
	'uses'=>'PageController@getSapXeptangTheoTen'
]);
Route::get('/ajax/tangtheoten_ajax','PageController@gettangTenAjax');
Route::get('sap-xep-giam-ten',[
	'as'=>'sapxepgiamten',
	'uses'=>'PageController@getSapXepgiamTheoTen'
]);
Route::get('/ajax/giamtheoten_ajax','PageController@getgiamTenAjax');
//THEO GIA
Route::get('sap-xep-tang-gia',[
	'as'=>'sapxeptanggia',
	'uses'=>'PageController@getSapXeptanggia'
]);
Route::get('/ajax/tangtheogia_ajax','PageController@gettangGiaAjax');
Route::get('sap-xep-giam-gia',[
	'as'=>'sapxepgiamgia',
	'uses'=>'PageController@getSapXepgiamgia'
]);
Route::get('/ajax/giamtheogia_ajax','PageController@getgiamGiaAjax');


Route::get('nguoidung','PageController@getNguoiDung');
Route::post('nguoidung','PageController@postNguoiDung');

//Route ADMIN
Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'theloai'],function(){
		//admin/theloai/danhsach
		Route::get('danhsach','PageController@getDanhSach');

		Route::get('sua/{id}','PageController@getSua');
		Route::post('sua/{id}','PageController@postSua');

		Route::get('them','PageController@getThem');
		Route::post('them','PageController@postThem');

		Route::get('xoa/{id}','PageController@getXoa');
	});
	Route::group(['prefix'=>'sanpham'],function(){
		//admin/sanpham/danhsach
		Route::get('danhsach','PageController@getDanhSachSP');
		Route::get('danhsachsanphammoi','PageController@getDanhSachSPMoi');
		Route::get('danhsachkhuyenmai','PageController@getDanhSachSPKM');
		Route::get('danhsachbanchay','PageController@getDanhSachSPBanChay');

		Route::get('sua/{id}','PageController@getSuaSP');
		Route::post('sua/{id}','PageController@postSuaSP');

		Route::get('them','PageController@getThemSP');
		Route::post('them','PageController@postThemSP');

		Route::get('xoa/{id}','PageController@getXoaSP');

		Route::get('themnhieuhinh','PageController@getThemNhieuHinhSP');
		Route::post('themnhieuhinh','PageController@postThemNhieuHinhSP');
	});
	Route::group(['prefix'=>'user'],function(){
		//admin/user/danhsach
		Route::get('danhsach','PageController@getDanhSachUS');


		Route::get('sua/{id}','PageController@getSuaUS');
		Route::post('sua/{id}','PageController@postSuaUS');

		Route::get('them','PageController@getThemUS');
		Route::post('them','PageController@postThemUS');

		Route::get('xoa/{id}','PageController@getXoaUS');
	});
	Route::group(['prefix'=>'slide'],function(){
		//admin/slide/danhsach
		Route::get('danhsach','PageController@getDanhSachSL');

		Route::get('sua/{id}','PageController@getSuaSL');
		Route::post('sua/{id}','PageController@postSuaSL');

		Route::get('them','PageController@getThemSL');
		Route::post('them','PageController@postThemSL');

		Route::get('xoa/{id}','PageController@getXoaSL');
	});
	Route::group(['prefix'=>'bill'],function(){
		Route::get('danhsach','PageController@getDanhSachBill');
		Route::get('danhsach/{id}','PageController@getDuyetDanhSachBill');



		Route::get('xemchitiet/{id}','PageController@getXemChiTietBill');

		Route::get('danhsachchuaduyet','PageController@getDanhSachBillChuaDuyet');
		Route::get('duyetdanhsachchuaduyet/{id}','PageController@getDuyetDanhSachBillChuaDuyet');

		Route::get('danhsachdanggiao','PageController@getDanhSachBillDangGiao');
		Route::get('duyetdanhsachdanggiao/{id}','PageController@getDuyetDanhSachBillDangGiao');

		Route::get('danhsachdagiao','PageController@getDanhSachBillDaGiao');
		Route::get('danhsachdaxoa','PageController@getDanhSachDaXoa');

		Route::get('xoa/{id}','PageController@getXoaDanhSachBill');
	});
	Route::group(['prefix'=>'doanhthu'],function(){
		Route::get('danhsach','PageController@getDanhSachDoanhThu');

		Route::get('danhsachcacngay','PageController@getDanhSachCacNgay');
		Route::get('danhsachcacthang','PageController@getDanhSachCacThang');


	});
});