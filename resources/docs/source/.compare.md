---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_53be1e9e10a08458929a2e0ea70ddb86 -->
## Find all dictionaries.

> Example request:

```bash
curl -X GET \
    -G "/" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": [
        {
            "id": 1,
            "name": "dictionary",
            "deleted_at": null,
            "created_at": "2019-11-20 20:38:14",
            "updated_at": "2019-11-20 20:38:14"
        }
    ]
}
```

### HTTP Request
`GET /`


<!-- END_53be1e9e10a08458929a2e0ea70ddb86 -->

<!-- START_5975a6c0572c50995bd4fc405aeb7a92 -->
## Find dictionary by id.

> Example request:

```bash
curl -X GET \
    -G "/find-by-id/1?id=nam" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/find-by-id/1"
);

let params = {
    "id": "nam",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary": {
            "dictionary": {
                "id": 1,
                "name": "dictionary",
                "deleted_at": null,
                "created_at": "2019-11-21 18:13:30",
                "updated_at": "2019-11-21 18:13:30"
            },
            "items": [
                {
                    "id": 1,
                    "name": "dictionary",
                    "dictionary_id": 1,
                    "deleted_at": null,
                    "created_at": "2019-11-21 18:13:30",
                    "updated_at": "2019-11-21 18:13:30"
                }
            ]
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (404):

```json
{
    "content": [],
    "error_messages": {
        "message": "",
        "code": 0
    }
}
```
> Example response (500):

```json
{
    "content": [],
    "error_messages": {
        "message": "Argument 2 passed to App\\Http\\Controllers\\FindDictionaryByIdController::findById() must be of the type int, string given",
        "code": 0
    }
}
```

### HTTP Request
`GET /find-by-id/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | integer required The id of dictionary.

<!-- END_5975a6c0572c50995bd4fc405aeb7a92 -->

<!-- START_4318c91e99ead36179d3d1c70e3cf940 -->
## Find dictionary by name.

> Example request:

```bash
curl -X GET \
    -G "/find-by-name/1?name=debitis" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/find-by-name/1"
);

let params = {
    "name": "debitis",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary": {
            "id": 1,
            "name": "dictionary",
            "deleted_at": null,
            "created_at": "2019-11-21 18:19:37",
            "updated_at": "2019-11-21 18:19:37"
        }
    },
    "error_messages": []
}
```
> Example response (404):

```json
{
    "content": [],
    "error_messages": {
        "message": "",
        "code": 0
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The selected name is invalid."
        ]
    }
}
```

### HTTP Request
`GET /find-by-name/{name}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `name` |  optional  | string required The name of dictionary.

<!-- END_4318c91e99ead36179d3d1c70e3cf940 -->

<!-- START_186f1bf97b31a54332e14fc7289acc56 -->
## Find trashed dictionaries.

> Example request:

```bash
curl -X GET \
    -G "/find-trashed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/find-trashed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": [],
    "error_messages": []
}
```
> Example response (200):

```json
{
    "content": [
        {
            "id": 1,
            "name": "dictionary",
            "deleted_at": "2019-11-21 18:36:19",
            "created_at": "2019-11-21 18:36:19",
            "updated_at": "2019-11-21 18:36:19"
        }
    ],
    "error_messages": []
}
```

### HTTP Request
`GET /find-trashed`


<!-- END_186f1bf97b31a54332e14fc7289acc56 -->

<!-- START_3334af40e9256fd67714367142d3dcc2 -->
## Find trashed dictionary by id.

> Example request:

```bash
curl -X GET \
    -G "/find-trashed/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/find-trashed/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary_item": [
            {
                "id": 2,
                "name": "dictionary 2",
                "deleted_at": "2019-11-21 19:02:46",
                "created_at": "2019-11-21 19:02:45",
                "updated_at": "2019-11-21 19:02:46"
            }
        ]
    },
    "error_messages": []
}
```
> Example response (200):

```json
{
    "content": {
        "dictionary_item": []
    },
    "error_messages": []
}
```
> Example response (500):

```json
{
    "content": [],
    "error_messages": {
        "message": "Argument 2 passed to App\\Http\\Controllers\\FindTrashedDictionaryByIdController::findTrashed() must be of the type int, string given",
        "code": 0
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```

### HTTP Request
`GET /find-trashed/{id}`


<!-- END_3334af40e9256fd67714367142d3dcc2 -->

<!-- START_b2b17caeb5a3fef742b0a1e1857d4f77 -->
## Find all dctionary items.

> Example request:

```bash
curl -X GET \
    -G "/dictionary-items" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/dictionary-items"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": [
        {
            "id": 1,
            "name": "hello",
            "dictionary_id": 1,
            "deleted_at": null,
            "created_at": "2019-11-20 20:42:23",
            "updated_at": "2019-11-20 20:42:23"
        }
    ],
    "error_messages": []
}
```

### HTTP Request
`GET /dictionary-items`


<!-- END_b2b17caeb5a3fef742b0a1e1857d4f77 -->

<!-- START_96fb3354c54f474170591c68c03de7f1 -->
## Find dictionary item by id.

> Example request:

```bash
curl -X GET \
    -G "/dictionary-items/find-by-id/1?id=ea" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/dictionary-items/find-by-id/1"
);

let params = {
    "id": "ea",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary_item": {
            "id": 1,
            "name": "item",
            "dictionary_id": 1,
            "deleted_at": null,
            "created_at": "2019-11-21 18:30:11",
            "updated_at": "2019-11-21 18:30:11"
        },
        "error_messages": []
    }
}
```
> Example response (404):

```json
{
    "content": [],
    "error_messages": {
        "message": "",
        "code": 0
    }
}
```
> Example response (500):

```json
{
    "content": [],
    "error_messages": {
        "message": "Argument 2 passed to App\\Http\\Controllers\\FindDictionaryItemByIdController::findById() must be of the type int, string given",
        "code": 0
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```

### HTTP Request
`GET /dictionary-items/find-by-id/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `id` |  optional  | integer required The id of dictionary item.

<!-- END_96fb3354c54f474170591c68c03de7f1 -->

<!-- START_39c27211b8d428339cbd19f55800d330 -->
## Find trashed dictionary items.

> Example request:

```bash
curl -X GET \
    -G "/dictionary-items/find-trashed" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/dictionary-items/find-trashed"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": [
        {
            "id": 1,
            "name": "item",
            "dictionary_id": 1,
            "deleted_at": "2019-11-21 19:25:27",
            "created_at": "2019-11-21 19:25:27",
            "updated_at": "2019-11-21 19:25:27"
        }
    ],
    "error_messages": []
}
```

### HTTP Request
`GET /dictionary-items/find-trashed`


<!-- END_39c27211b8d428339cbd19f55800d330 -->

<!-- START_3304d3fa58395c56d3d612be60414d62 -->
## Find trashed dictionary item.

> Example request:

```bash
curl -X GET \
    -G "/dictionary-items/find-single-trashed/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/dictionary-items/find-single-trashed/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": [
        {
            "id": 1,
            "name": "hello",
            "dictionary_id": 1,
            "deleted_at": "2019-11-21 19:20:48",
            "created_at": "2019-11-21 19:20:48",
            "updated_at": "2019-11-21 19:20:48"
        }
    ],
    "error_messages": []
}
```
> Example response (404):

```json
{
    "content": [],
    "error_messages": {
        "message": "",
        "code": 0
    }
}
```
> Example response (500):

```json
{
    "content": [],
    "error_messages": {
        "message": "Argument 2 passed to App\\Http\\Controllers\\FindTrashedDictionaryItemController::find() must be of the type int, string given",
        "code": 0
    }
}
```

### HTTP Request
`GET /dictionary-items/find-single-trashed/{id}`


<!-- END_3304d3fa58395c56d3d612be60414d62 -->

<!-- START_bc05019f8e3ad49eb15ba5bad0647e7f -->
## Create dictionary.

> Example request:

```bash
curl -X POST \
    "/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"name":"rem"}'

```

```javascript
const url = new URL(
    "/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "name": "rem"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary": {
            "name": "dictionary 1",
            "created_at": "2019-11-20 20:03:16",
            "updated_at": "2019-11-20 20:03:16",
            "id": 2
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name must be a string."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name has already been taken."
        ]
    }
}
```

### HTTP Request
`POST /create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `name` | string |  required  | The name of dictionary.
    
<!-- END_bc05019f8e3ad49eb15ba5bad0647e7f -->

<!-- START_6789a831c5e460159749a3905733c96d -->
## Create dictionary item.

> Example request:

```bash
curl -X POST \
    "/dictionary-item/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/dictionary-item/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary_item": {
            "name": "item 2",
            "dictionary_id": 1,
            "updated_at": "2019-11-20 20:12:53",
            "created_at": "2019-11-20 20:12:53",
            "id": 2
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name must be a string."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "dictionary_id": [
            "The dictionary id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "dictionary_id": [
            "The dictionary id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "dictionary_id": [
            "The selected dictionary id is invalid."
        ]
    }
}
```

### HTTP Request
`POST /dictionary-item/create`


<!-- END_6789a831c5e460159749a3905733c96d -->

<!-- START_f90b1960c1622f7df69bf8460be5930c -->
## Update dictionary controller.

> Example request:

```bash
curl -X PUT \
    "/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":14,"name":"et"}'

```

```javascript
const url = new URL(
    "/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 14,
    "name": "et"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name must be a string."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name has already been taken."
        ]
    }
}
```
> Example response (200):

```json
{
    "content": {
        "dictionary": {
            "id": 1,
            "name": "dictionary 1",
            "deleted_at": null,
            "created_at": "2019-11-21 20:31:50",
            "updated_at": "2019-11-21 20:31:50"
        }
    },
    "error_messages": []
}
```

### HTTP Request
`PUT /update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | Id of dictionary.
        `name` | string |  required  | Name of dictionary.
    
<!-- END_f90b1960c1622f7df69bf8460be5930c -->

<!-- START_08ff48fe28ed0136b4f8fc0e28bc29d6 -->
## Restore dictionary.

> Example request:

```bash
curl -X PUT \
    "/restore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":1}'

```

```javascript
const url = new URL(
    "/restore"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 1
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "content": {
        "dictionaries": {
            "id": 1,
            "name": "dictionary",
            "deleted_at": null,
            "created_at": "2019-11-21 20:05:29",
            "updated_at": "2019-11-21 20:05:29"
        }
    },
    "error_messages": []
}
```

### HTTP Request
`PUT /restore`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | 
    
<!-- END_08ff48fe28ed0136b4f8fc0e28bc29d6 -->

<!-- START_1caca231df98748efcfd16eebf8254c5 -->
## Update dictionary item.

> Example request:

```bash
curl -X PUT \
    "/dictionary-item/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":15,"name":"eum","dictionary_id":1}'

```

```javascript
const url = new URL(
    "/dictionary-item/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 15,
    "name": "eum",
    "dictionary_id": 1
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
null
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "name": [
            "The name must be a string."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "dictionary_id": [
            "The dictionary id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "dictionary_id": [
            "The dictionary id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "dictionary_id": [
            "The selected dictionary id is invalid."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": {
        "dictionary": {
            "id": 1,
            "name": "item",
            "dictionary_id": 1,
            "deleted_at": null,
            "created_at": "2019-11-21 20:53:10",
            "updated_at": "2019-11-21 20:53:10"
        }
    },
    "error_messages": []
}
```
> Example response (200):

```json
{
    "content": {
        "dictionary": {
            "id": 1,
            "name": "item",
            "dictionary_id": 1,
            "deleted_at": null,
            "created_at": "2019-11-21 20:51:59",
            "updated_at": "2019-11-21 20:51:59"
        }
    },
    "error_messages": []
}
```

### HTTP Request
`PUT /dictionary-item/update`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | Id of dictionary item.
        `name` | string |  required  | The name of dictionary item.
        `dictionary_id` | integer |  required  | The name of dictionary item.
    
<!-- END_1caca231df98748efcfd16eebf8254c5 -->

<!-- START_faf95f11d1dd211508bed8cb2716d909 -->
## Restore dictionary item.

> Example request:

```bash
curl -X PUT \
    "/dictionary-item/restore" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":19}'

```

```javascript
const url = new URL(
    "/dictionary-item/restore"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 19
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "content": {
        "dictionary_item": {},
        "error_messages": []
    }
}
```

### HTTP Request
`PUT /dictionary-item/restore`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | The id of dictionary id.
    
<!-- END_faf95f11d1dd211508bed8cb2716d909 -->

<!-- START_d3e7f6f3258fb1a0d0fc066c0c8eba5c -->
## Delete dictionary.

> Example request:

```bash
curl -X DELETE \
    "/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary": {
            "id": 1,
            "name": "dictionary",
            "deleted_at": "2019-11-20 20:24:18",
            "created_at": "2019-11-20 20:24:17",
            "updated_at": "2019-11-20 20:24:18"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (200):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```

### HTTP Request
`DELETE /delete`


<!-- END_d3e7f6f3258fb1a0d0fc066c0c8eba5c -->

<!-- START_c273d4a8e8476bea9a8b6f82650c0f18 -->
## Force delete dictionary.

> Example request:

```bash
curl -X DELETE \
    "/force-delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":19}'

```

```javascript
const url = new URL(
    "/force-delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 19
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "content": {
        "dictionary": {}
    },
    "error_messages": []
}
```

### HTTP Request
`DELETE /force-delete`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | The id of dictionary.
    
<!-- END_c273d4a8e8476bea9a8b6f82650c0f18 -->

<!-- START_272389599eaf2d349ad9e5012f80286a -->
## Delete dictionary item.

> Example request:

```bash
curl -X DELETE \
    "/dictionary-item/delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "/dictionary-item/delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "content": {
        "dictionary_item": {
            "id": 1,
            "name": "item",
            "dictionary_id": 1,
            "deleted_at": "2019-11-20 20:36:22",
            "created_at": "2019-11-20 20:36:20",
            "updated_at": "2019-11-20 20:36:22"
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```

### HTTP Request
`DELETE /dictionary-item/delete`


<!-- END_272389599eaf2d349ad9e5012f80286a -->

<!-- START_199d40312c7892b28ba792fc59d6c33b -->
## Force delete dictionary item.

> Example request:

```bash
curl -X DELETE \
    "/dictionary-item/force-delete" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"id":19}'

```

```javascript
const url = new URL(
    "/dictionary-item/force-delete"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "id": 19
}

fetch(url, {
    method: "DELETE",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id field is required."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The id must be an integer."
        ]
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "id": [
            "The selected id is invalid."
        ]
    }
}
```
> Example response (200):

```json
{
    "content": {
        "dictionary_item": {}
    },
    "error_messages": []
}
```

### HTTP Request
`DELETE /dictionary-item/force-delete`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `id` | integer |  required  | The id of dictionary item.
    
<!-- END_199d40312c7892b28ba792fc59d6c33b -->


