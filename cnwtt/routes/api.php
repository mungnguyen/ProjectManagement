<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


// Learning API
route::get('HelloWorld', function(Request $request){
    return response()->json('Hello Anh Phuong den voi api', 200);
});

route::get('Hello/{name}/{age}', function(Request $request, $name, $age){
    return response()->json('Hello ' . $name . '. Your age: ' . $age, 200);
});

route::get('Permision/{age?}', function(Request $request, $age = 17){
    if($age < 18){
        $str = "Tre con khong duoc an thit cho";
    }else{
        $str = "Nguoi lon duoc phep truy cap";
    }
    return response()->json($str, 200);
});

Route::get('/books', function(Request $request){
    $entries = [
        [
            "isbn" => "9781593275846",
            "title" => "Eloquent JavaScript, Second Edition",
            "author" => "Marijn Haverbeke"      
        ],
        [
            "isbn" => "9781449331818",
            "title" => "Learning JavaScript Design Patterns",
            "author" => "Addy Osmani"
        ],
        [
            "isbn" => "9781449365035",
            "title" => "Speaking JavaScript",
            "author" => "Axel Rauschmayer",
        ],
        [
            "isbn" => "9781491950296",
            "title" => "Programming JavaScript Applications",
            "author" => "Eric Elliott"
        ]
    ];
    return response()->json($entries, 200);
});

Route::post('/books', function(Request $request){
    
    $entries = [
        [
            "isbn" => "9781593275846",
            "title" => "Eloquent JavaScript, Second Edition",
            "author" => "Marijn Haverbeke"      
        ],
        [
            "isbn" => "9781449331818",
            "title" => "Learning JavaScript Design Patterns",
            "author" => "Addy Osmani"
        ]
    ];

    // Get book data from POST
    $book = [
        "isbn" => $request->input('isbn'),
        "title" => $request->input('title'),
        "author" => $request->input('author')
    ];

    // Append news book into current list.
    $entries[] = $book;

    return response()->json($entries, 200);
});

Route::post('/append', function(Request $request){
    
    $entries = [
        [
            "isbn" => "9781593275846",
            "title" => "Eloquent JavaScript, Second Edition",
            "author" => "Marijn Haverbeke"      
        ],
        [
            "isbn" => "9781449331818",
            "title" => "Learning JavaScript Design Patterns",
            "author" => "Addy Osmani"
        ]
    ];
 
    // Get book data from POST
    $book = [
        "isbn" => $request->input('isbn'),
        "title" => $request->input('title'),
        "author" => $request->input('author')
    ];
 
    // Append news book into current list.
    $entries[] = $book;
 
    return response()->json($entries, 200);
});


//test api tu viet

route::get('sanpham', 'ControllerSanPham@index');
route::get('sanpham/{id}', 'ControllerSanPham@show');
route::post('sanpham', 'ControllerSanPham@store');
route::put('sanpham/{id}', 'ControllerSanPham@update');
route::delete('sanpham/{id}', 'ControllerSanPham@destroy');


// Start Project

// Acount

route::post('login', 'PassportController@login');
route::post('register', 'PassportController@register');
route::put('updatepassword/{id}', 'PasswordController@update');
route::put('updateaccount/{id}', 'AccountController@update');


// Personal
    // Tất cả phải truyền lên Authorization = 'Bearer' + ' ' + 'Mã Token'
    // để xác thực người dùng
route::middleware('auth:api')->group(function () {
    route::get('personal', 'PersonalController@index');
    route::get('personal/{id}', 'PersonalController@show');

    // Chuyền lên: personal_name, personal_process
    route::post('personal', 'PersonalController@store');
    // Chuyền lên: personal_name, personal_process mới để cập nhật
    route::put('personal/{id}', 'PersonalController@update');
    route::delete('personal/{id}', 'PersonalController@destroy');
   
});

// Hiển thị phần trăm của personal hiện tại
route::get('percentpersonal/{id}', 'PersonalController@percent');


// PTask

    // Lấy ra tất cả các p_task của personal_id chuyền vào personal_id
route::get('allptask/{personal_id}', 'PTaskController@index');
    // Lấy ra p_task có id là id
route::get('ptask/{id}', 'PTaskController@show');
    // Tạo p_task mới chuyền lên: p_task_name, personal_id
route::post('ptask', 'PTaskController@store');
    // Cập nhật p_task chuyền lên: p_task_name hoặc p_task_tick
route::put('ptask/{id}', 'PTaskController@update');
    // Xóa  p_task có id là id
route::delete('ptask/{id}', 'PTaskController@destroy');


// Comment

    // Lấy ra tất cả các comment trong một job truyền vào job_id
route::get('allcomment/{job_id}', 'CommentController@index');

    // Làm việc với comment thông qua người dùng cần phải xác thực, truyền thêm:
    // Authorization = 'Bearer' + ' ' + 'Mã Token'
route::middleware('auth:api')->group(function(){
    // Hiển thị một comment của một người cụ thể truyền vào id của comment
    route::get('comment/{id}', 'CommentController@show');
    // Lưu lại một comment truyền vào: content, job_id
    route::post('comment', 'CommentController@store');
    // Cập nhật nội dung của comment truyền vào: conntent
    route::put('comment/{id}', 'CommentController@update');
    // Xóa một comment truyền vào id của comment
    route::delete('comment/{id}', 'CommentController@destroy');
});


    





