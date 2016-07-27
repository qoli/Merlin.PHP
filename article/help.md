# 幫助檔案 2016年07月27日

##### 使用之前

請先參閱 Github 上面的項目說明，以保證在路由器上，已經安裝足夠的相關軟件。

並且，本工具目前只支持 KoolShare.io 提供的固件。另外，在目前來說，也只是提供遊戲模式和 V2 的操作支持，如果你還是想使用更多的內容，請從原來的面板操作。

另外，由於「在線更新」正在開發當中，所以菜單中的這個按鈕是無法使用的，如果你看到了的話。



##### 第一次使用

- 在後臺選擇一個支持「**遊戲模式 V2**」的 SS，并啟用一次。
- 在本工具選擇「Game-Mode」或「Game-V2」進行初始化。




##### 使用本工具解決問題

- 當你的 PS4 在 **NAT 衝突**時候：使用重啟服務下的「Network」；
- 當你的**無法聯網時候**，請重啟「ShadowSocks」；
- 當你看到下方的 **Google 轉為紅色時候**，也說明你的國外連線已經失敗，點一下「ShadowSocks」就可以了。
- 當**「 SS 模式」沒有結果時候**，請從菜單，重新選擇一個 SS 模式或更換 SS 模式。


在缺乏 SS 模式時候，重啟「ShadowSocks」功能將沒有效果。



##### FAQ 🙋🏻

**我要怎麼更改服務器呢？**

在 0.3 版本開始提供了「切換線路」功能了。

**我要如何判斷網絡狀態呢？**

可以透過「網路測試」功能來實行這個任務。

**我想進行完全的 SS 重啟**

從菜單，選擇 Game-V2 或者 Game-Mode 就是完全的 SS 重啟了。

**Google Timeout？**

當顯示 Google Timeout 的時候，說明了 SS 沒有正常工作。請先嘗試快速重啟 ShadowSocks 后，如果失敗，請切換伺服器或者 DNS 等手段嘗試恢復，並且確定服務器是否正常工作。

**我為什麼選擇了 Game-V2 之後，顯示 Google Timeout？**

請你確認你的伺服器（線路）是否支持 Game-V2 模式，具體請參考：http://koolshare.cn/thread-38263-1-1.html



##### 自動更新

在自動更新中，如果失敗的話。請手動運行如下命令：

`wget --no-check-certificate https://github.com/qoli/Merlin.PHP/raw/master/bin/install/install.sh -O install.sh`

`chmod +x install.sh`

`./install.sh`

導致這個問題是由於 0.1 版本中有錯誤的 tar 參數。



##### 其他

**Debug 菜單**

在設定中，在地址欄后添加「?d=1」即可。




##### 了解更多

http://github.com/qoli/Merlin.PHP



##### 提交問題

https://github.com/qoli/Merlin.PHP/issues