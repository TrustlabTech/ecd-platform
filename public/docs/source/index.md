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
<!-- START_848e6cdaa40a06e31802c1fb76658b76 -->
## Retrieve All Centres

Token must be suplied as query string: external/api/v1/centre?token=your-token-here

> Example request:

```bash
curl "http://localhost/external/api/v1/centre" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/external/api/v1/centre",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET external/api/v1/centre`

`HEAD external/api/v1/centre`


<!-- END_848e6cdaa40a06e31802c1fb76658b76 -->
<!-- START_6cd4e56cf917a30fc06627585861a3a9 -->
## Retrieve all Staff

Token must be suplied as query string: external/api/v1/staff?token=your-token-here

> Example request:

```bash
curl "http://localhost/external/api/v1/staff" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/external/api/v1/staff",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET external/api/v1/staff`

`HEAD external/api/v1/staff`


<!-- END_6cd4e56cf917a30fc06627585861a3a9 -->
<!-- START_c7146d85b884be528ccfb6b0132fdcbc -->
## Retrieve All Classes

Token must be suplied as query string: external/api/v1/class?token=your-token-here

> Example request:

```bash
curl "http://localhost/external/api/v1/class" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/external/api/v1/class",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET external/api/v1/class`

`HEAD external/api/v1/class`


<!-- END_c7146d85b884be528ccfb6b0132fdcbc -->
<!-- START_234b9b02347012491639c3b3ee63b104 -->
## Retrieve all Children

Token must be suplied as query string: external/api/v1/child?token=your-token-here

> Example request:

```bash
curl "http://localhost/external/api/v1/child" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/external/api/v1/child",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET external/api/v1/child`

`HEAD external/api/v1/child`


<!-- END_234b9b02347012491639c3b3ee63b104 -->
<!-- START_8c1c9853ac29947a2643ea0306cef1c1 -->
## Retrieve Child Attendance Records

Token must be suplied as query string: external/api/v1/attendance?token=your-token-here

> Example request:

```bash
curl "http://localhost/external/api/v1/attendance" \
-H "Accept: application/json"
```

```javascript
var settings = {
    "async": true,
    "crossDomain": true,
    "url": "http://localhost/external/api/v1/attendance",
    "method": "GET",
    "headers": {
        "accept": "application/json"
    }
}

$.ajax(settings).done(function (response) {
    console.log(response);
});
```

> Example response:

```json
null
```

### HTTP Request
`GET external/api/v1/attendance`

`HEAD external/api/v1/attendance`


<!-- END_8c1c9853ac29947a2643ea0306cef1c1 -->
