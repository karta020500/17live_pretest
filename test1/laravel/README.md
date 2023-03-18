## 建立專案

1. 下載專案原始碼，並在終端機進入專案目錄。
2. 在終端機輸入 composer install 安裝相依套件。
3. 複製 .env.example 檔案並重新命名為 .env，然後在檔案裡填入對應的資料庫連線資訊。
4. 在終端機輸入 php artisan migrate 建立資料庫表格。
5. 在終端機輸入 php artisan test 測試新增post及comment api運作正常。


