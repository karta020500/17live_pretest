<?php
// 題目: Laravel 當中的 middleware 能夠在進入 controller 和離開 controller 後提供額外的操作，參考官方文件 。若換成自己設計類似的 middleware ，請描述一下會如何設計以及設計的做法。

// 設計重點
// 首先middleware的設計重點我覺得有兩個
// 1. 能夠控制是要在controller前或後執行
// 2. 可以有多層的middleware處理，並且可以控制處理順序


// 設計重點1的實作方式(能夠控制是要在controller前或後執行)
// 其中一種方法就是在contrller被調用前就有middleware的實例可以使用，所以可以在例如bootstrap的過程中先建立好middleware的實例以便後續使用
// 實際使用的時候，可以在route的回調函數前或後呼叫middleware的方法來處理請求，範例如下:

// controller前處理
Route::get('/dashboard')->middleware('my_middleware', function () {
      //處理請求
});

// controller後處理
Route::get('/dashboard', function () {
     //處理請求
})->middleware('my_middleware');

// 設計重點2的實作方式(以有多層的middleware處理，並且可以控制處理順序)
// 這部分可以參考laravel的middleware的實作方法，要實作middleware方法都需要有個handle function並且要有兩個參數分別為: 1. request 2. next
// request就是封裝HTTP請求的資訊，而這裡的middleware也是針對這個HTTP請求做處理，所以都傳遞這個就可以了
// next型別是一個Closure，可以呼叫下一層middleware的handle並且將request傳遞給他，範例如下:

public function handle($request, Closure $next)
{
    if (!Auth::user()->canAccessPage()) {
        return redirect('/login');
    }

    return $next($request);
}

// 在這個例子中，如果使用者沒有權限訪問頁面，middleware 會將使用者重定向到登錄頁面，有權限就會調用下一個 middleware的Closure，並繼續處理請求。