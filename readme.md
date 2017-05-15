# ecd-platform
## ECD Platform - Laravel API


## Admin Endpoints / These will be used on the backend for administration
These endpoints may be used for the RN Application in the future. All middleware
is in place to guard these for Admin or Staff rights. (TODO: Assign the middleware
 individually to the respective routes)


### Centre Endpoints:
```
+-----------+-----------------------------------------------------------------------------------+
| Method    | URI                              | Action                                         |
+-----------+-----------------------------------------------------------------------------------+
| POST      | api/v1/centre                    | App\Http\Controllers\CentreController@store    |
| GET|HEAD  | api/v1/centre                    | App\Http\Controllers\CentreController@index    |
| DELETE    | api/v1/centre/{centre}           | App\Http\Controllers\CentreController@destroy  |
| GET|HEAD  | api/v1/centre/{centre}           | App\Http\Controllers\CentreController@show     |
| PUT|PATCH | api/v1/centre/{centre}           | App\Http\Controllers\CentreController@update   |
+-----------+----------------------------------+------------------------------------------------+
```

### Children Endpoints:
```
+-----------+----------------------------------+-----------------------------------------------+
| Method    | URI                              | Action                                        |
+-----------+----------------------------------------------------------------------------------+
| POST      | api/v1/child                     | App\Http\Controllers\ChildController@store    |
| GET|HEAD  | api/v1/child                     | App\Http\Controllers\ChildController@index    |
| PUT|PATCH | api/v1/child/{child}             | App\Http\Controllers\ChildController@update   |
| GET|HEAD  | api/v1/child/{child}             | App\Http\Controllers\ChildController@show     |
| DELETE    | api/v1/child/{child}             | App\Http\Controllers\ChildController@destroy  |
+-----------+----------------------------------+-----------------------------------------------+
```

### Class Endpoints:
```
+-----------+----------------------------------+----------------------------------------------------+
| Method    | URI                              | Action                                             |
+-----------+----------------------------------+----------------------------------------------------+
| POST      | api/v1/class                     | App\Http\Controllers\CentreClassController@store   |
| GET|HEAD  | api/v1/class                     | App\Http\Controllers\CentreClassController@index   |
| PUT|PATCH | api/v1/class/{class}             | App\Http\Controllers\CentreClassController@update  |
| DELETE    | api/v1/class/{class}             | App\Http\Controllers\CentreClassController@destroy |
| GET|HEAD  | api/v1/class/{class}             | App\Http\Controllers\CentreClassController@show    |
+-----------+----------------------------------+----------------------------------------------------+
```

### Staff Endpoints:
```
+-----------+----------------------------------+-----------------------------------------------+
| Method    | URI                              | Action                                        |
+-----------+----------------------------------+-----------------------------------------------+
| GET|HEAD  | api/v1/staff                     | App\Http\Controllers\StaffController@index    |
| POST      | api/v1/staff                     | App\Http\Controllers\StaffController@store    |
| PUT|PATCH | api/v1/staff/{staff}             | App\Http\Controllers\StaffController@update   |
| GET|HEAD  | api/v1/staff/{staff}             | App\Http\Controllers\StaffController@show     |
| DELETE    | api/v1/staff/{staff}             | App\Http\Controllers\StaffController@destroy  |
+-----------+----------------------------------+-----------------------------------------------+
```

### Admin Endpoints:
```
+-----------+----------------------------------+----------------------------------------------------+
| Method    | URI                              | Action                                             |
+-----------+----------------------------------+----------------------------------------------------+
| POST      | api/admin/login                  | App\Http\Controllers\AdminAuthController@postLogin |
+-----------+----------------------------------+----------------------------------------------------+
TODO: Admin sign-out Endpoint
```

## RN Application Endpoints:

### Public Staff/Facilitator Endpoints:
```
+-----------+----------------------------------+-------------------------------------------------------+
| Method    | URI                              | Action                                                |
+-----------+----------------------------------+-------------------------------------------------------+
| POST      | api/v1/staff/login               | App\Http\Controllers\StaffAuthController@postLogin    |
| POST      | api/v1/staff/register            | App\Http\Controllers\StaffAuthController@postRegister |
+-----------+----------------------------------+-------------------------------------------------------+
```

## Public Endpoints needed for registration.
These endpoints only expose what is needed for registration.
```
+-----------+----------------------------------+---------------------------------------------------------------+
| Method    | URI                              | Action                                                        |
+-----------+----------------------------------+---------------------------------------------------------------+
| GET|HEAD  | api/v1/public/centres            | App\Http\Controllers\CentreController@indexByPublic           |
| GET|HEAD  | api/v1/public/ecd_qualifications | App\Http\Controllers\ECDQualificationController@indexByPublic |
+-----------+----------------------------------+---------------------------------------------------------------+
```

## Class and Child Endpoints:
These endpoints are not public
```
+-----------+----------------------------------+---------------------------------------------------------+
| Method    | URI                              | Action                                                  |
+-----------+----------------------------------+---------------------------------------------------------+
| GET|HEAD  | api/v1/class/centre/{id}         | App\Http\Controllers\CentreClassController@indexByCentre|
| GET|HEAD  | api/v1/child/class/{id}          | App\Http\Controllers\ChildController@indexByClass       |
+-----------+----------------------------------+---------------------------------------------------------+
TODO: Child Attendance Endpoint
```
