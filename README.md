# Sesame3/4/5 SmartLock Api client.

[![Packagist](https://img.shields.io/badge/packagist-v1.0.0-blue.svg)](https://packagist.org/packages/chanshige/sesame)
[![CI](https://github.com/chanshige/sesame/actions/workflows/ci.yml/badge.svg)](https://github.com/chanshige/sesame/actions/workflows/ci.yml)

CandyHouseのSesameスマートロックAPIを利用するためのライブラリです。  
This library is for using the [sesame3/4/5](https://jp.candyhouse.co/) smart lock API.  
※ OpenSSL Crypto library (ext-crypto) is required.

Installation
--
```
※準備中
$ composer require chanshige/sesame
```

Usage
--
```injectablephp
<?php
// initialize
use Chanshige\SmartLock\Sesame\Action;
use Chanshige\SmartLock\Sesame\Client;
use Chanshige\SmartLock\Sesame\Device;

$sesame = Client::newInstance('sesame-api-key');

$device = new Device(
    uuid: '488ABAAB-164F-7A86-595F-DDD778CB86C3', // Sesameデバイス固有のID
    secretKey: 'a13d4b890111676ba8fb36ece7e94f7d', // デバイスを操作するための鍵
);
// ※ 2023/12現在、https://partners.candyhouse.co/login から取得可能でした。
```

### Sesameの状態を取得
```injectablephp
$response = $sesame(new Action\Status($device));
```

### Sesameの履歴を取得
```injectablephp
$response = $sesame(new Action\History($device, 1, 100));
```

### Sesameの施解錠
```injectablephp
// 鍵をかける
$response = $sesame(new Action\Lock($device, 'chanshigeが鍵かけた'));

// 鍵をあける
$response = $sesame(new Action\UnLock($device, 'chanshigeが鍵あけた'));

// 鍵をひたすら回す
$response = $sesame(new Action\Toggle($device, 'chanshigeが操作した'));
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