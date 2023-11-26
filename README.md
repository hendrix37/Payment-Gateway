
# Payment Gateway

detail api list and recomended Payment Gateway


## API Reference

### API Reference For Customer

#### 1. Get saldo

```https
  GET /api/v1/saldo
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Response
```json
{
    "status": 200,
    "message": "Success ,Get Saldo",
    "data": {
        "saldo": 20000,
        "user_name": "aryo"
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.saldo` | `integer` | saldo by user |
| `data.user_name` | `string` | name by user |

#### 2. Get History

```https
  POST /api/v1/hitory
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key. |
| `authorization` | `string` | **Required**. Your authorization |

#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `start_date` | `date` | **Required**. **2023-11-24** |
| `end_date` | `date` | **Required**. **2023-11-24** |


#### Response
```json
{
    "status": 200,
    "message": "Success ,Get Saldo",
    "date": {
        "usage": [
            {
                "user_name": "aryo2",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            },
            {
                "user_name": "aryo3",
                "date_time": "2023-11-26 12:32:12",
                "amount": "-2000"
            },
            {
                "user_name": "aryo1",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            }
        ],
        "top_up": [
            {
                "user_name": "aryo2",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            },
            {
                "user_name": "aryo3",
                "date_time": "2023-11-26 12:32:12",
                "amount": "-2000"
            },
            {
                "user_name": "aryo1",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            }
        ]
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.usage` | `integer` | usage by user |
| `data.usage.*.user_name` | `string` | name by user |
| `data.usage.*.date_time` | `string` | date transaction by user |
| `data.usage.*.amount` | `string` | amount transaction by user |
| `data.top_up.*.user_name` | `string` | name by user |
| `data.top_up.*.date_time` | `string` | date transaction by user |
| `data.top_up.*.amount` | `string` | amount transaction by user |

#### 3. Post Top Up

```https
  POST /api/v1/top-up
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `amount` | `integer` | **Required**. **20000** |


#### Response
```json
{
    "status": 200,
    "message": "Success , Top Up",
    "data": {
        "amount": 20000,
        "saldo": 20000
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.amount` | `integer` | amount top up by user |
| `data.saldo` | `integer` | saldo by user |

#### 4. Post Pay

```https
  POST /api/v1/pay
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `amount` | `integer` | **Required**. **20000** |
| `driver_code` | `string` | **Required**. **DRV001** |


#### Response
```json
{
    "status": 200,
    "message": "Success , send",
    "data": {
        "amount": 20000,
        "saldo": 0
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.amount` | `integer` | amount top up by user |
| `data.saldo` | `integer` | saldo by user |


### API Reference For Driver

#### 1. Get saldo driver

```https
  GET /api/v1/saldo-driver
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Response
```json
{
    "status": 200,
    "message": "Success ,Get Saldo",
    "data": {
        "saldo": 20000,
        "user_name": "aryo"
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.saldo` | `integer` | saldo by user |
| `data.user_name` | `string` | name by user |

#### 2. Get History

```https
  POST /api/v1/hitory-driver
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key. |
| `authorization` | `string` | **Required**. Your authorization |

#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `start_date` | `date` | **Required**. **2023-11-24** |
| `end_date` | `date` | **Required**. **2023-11-24** |


#### Response
```json
{
    "status": 200,
    "message": "Success ,Get Saldo",
    "date": {
        "usage": [
            {
                "user_name": "aryo2",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            },
            {
                "user_name": "aryo3",
                "date_time": "2023-11-26 12:32:12",
                "amount": "-2000"
            },
            {
                "user_name": "aryo1",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            }
        ],
        "top_up": [
            {
                "user_name": "aryo2",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            },
            {
                "user_name": "aryo3",
                "date_time": "2023-11-26 12:32:12",
                "amount": "-2000"
            },
            {
                "user_name": "aryo1",
                "date_time": "2023-11-26 12:32:12",
                "amount": "+50000"
            }
        ]
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.usage` | `integer` | usage by user |
| `data.usage.*.user_name` | `string` | name by user |
| `data.usage.*.date_time` | `string` | date transaction by user |
| `data.usage.*.amount` | `string` | amount transaction by user |
| `data.top_up.*.user_name` | `string` | name by user |
| `data.top_up.*.date_time` | `string` | date transaction by user |
| `data.top_up.*.amount` | `string` | amount transaction by user |

#### 3. Post Top Up

```https
  POST /api/v1/top-up-driver
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `amount` | `integer` | **Required**. **20000** |


#### Response
```json
{
    "status": 200,
    "message": "Success , Top Up",
    "data": {
        "amount": 20000,
        "saldo": 20000
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.amount` | `integer` | amount top up by user |
| `data.saldo` | `integer` | saldo by user |

#### 4. Post withdraw

```https
  POST /api/v1/withdraw-driver
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `amount` | `integer` | **Required**. **20000** |


#### Response
```json
{
    "status": 200,
    "message": "Success , send",
    "data": {
        "amount": 20000,
        "saldo": 0
    }
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.amount` | `integer` | amount top up by user |
| `data.saldo` | `integer` | saldo by user |

#### 5. Post add bank account

```https
  POST /api/v1/add-bank-account
```
#### Header

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |
| `authorization` | `string` | **Required**. Your authorization |


#### Parameter

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `number_account` | `integer` | **Required**. **20000** |
| `bank_name` | `string` | **Required**. **BRI** |
| `bank_alias_name` | `string` | **Required**. **ARYO** |


#### Response
```json
{
    "status": 200,
    "message": "Success , add account bank",
}
```
| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `status` | `integer` | is status code like 200, 201, 404, 400, 500 |
| `message` | `string` | message from response |
| `data` | `string` | respon data in array |
| `data.amount` | `integer` | amount top up by user |
| `data.saldo` | `integer` | saldo by user |



## Recomend payment gateway


| **Faspay.co.id** |                 
| :-------- |
| **Price** |   
| Rp. 4.000 / Transaksi |
| **Advantages Payment Gateway** |   
| Terima Pembayaran |
| Tagihan Online |
| Mengirim Dana |
| Tarik Tunai |
| QRIS |
| Pinjaman Dana Usaha |

| **Flip.id** |                 
| :-------- |
| ** Price** |   
| Rp. 2.400 / Transfer ke bank widthdraw|
| Rp. 2.000 / Terima Pembayaran  |
| **Advantages Payment Gateway** |   
| Terima Pembayaran |
| Tagihan Online |
| Mengirim Dana |
| Tarik Tunai |
| QRIS |
| Pinjaman Dana Usaha |


