# Sesame3 SmartLock Api client.

CandyHouseのSesameスマートロックAPIを利用するためのライブラリです。  
This library is for using the [sesame3](https://jp.candyhouse.co/) smart lock API.  
※ OpenSSL Crypto library (ext-crypto) is required.

Installation
--
```
※準備中
$ composer require chanshige/sesame-client
```

Usage
--
```injectablephp
<?php
// initialize
use Chanshige\SmartLock\Action;
use Chanshige\SmartLock\Sesame;

$uuid = '488ABAAB-164F-7A86-595F-DDD778CB86C3'; // Sesameデバイス固有のID
$secretKey = 'a13d4b890111676ba8fb36ece7e94f7d' // デバイスを操作するための鍵

$sesame = Sesame::newInstance('sesame-api-key');
```

### Sesameの状態を取得
```injectablephp
$response = $sesame($uuid, new Action\Status());
```

### Sesameの履歴を取得
```injectablephp
$response = $sesame($uuid, new Action\History());
```

### Sesameの施解錠
```injectablephp
// 鍵をかける
$response = $sesame($uuid, new Action\Lock($secretKey, 'chanshigeが鍵かけた'));

// 鍵をあける
$response = $sesame($uuid, new Action\UnLock($secretKey, 'chanshigeが鍵あけた'));

// 鍵をひたすら回す
$response = $sesame($uuid, new Action\Toggle($secretKey, 'chanshigeが操作した'));
```
Test
--
```
$ composer tests
```

Contributing
--
Feel free to create issues and submit pull requests. For any PR submitted, make sure it is covered by tests or include new tests.

Security
--
If you discover any security related issues, please email author email instead of using the issue tracker.

License
--
MIT

Author
--
[chanshige](https://twitter.com/chanshige)