# NGWordBAN

NGワードを発言するとBANします

# 使い方

## コマンドでNGワードを登録  
/ngword(ngw) [NGワード]

## config.ymlで登録  
```NGWord:
          -hoge  ```

Gワードを発言した人はまずconfig.ymlのBlacklistに名前が書き込まれ、再度NGワードを発言した場合にBANされます
