# OpenMeetingsSoap

a library for Yii2, to make integration with Apache openmeetings much easier.

## Installation:

The preferred way to install this extension is through composer.

Either run

php composer.phar require hakeem23/openmeetings 'dev-master'

or add

"hakeem23/openmeetings": "*dev-master"

to the require section of your composer.json file.

## main.php or web.php configration file

add the following inside components.

```
'userService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/UserService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'roomService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/RoomService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'infoServices' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/InfoService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'calendarService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/CalendarService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'errorService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/ErrorService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'fileService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/FileService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'groupService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/GroupService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
        'recordingService' => [
            'class' => 'mongosoft\soapclient\Client',
            'url' => 'http://localhost:5080/openmeetings/services/RecordService?wsdl',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
            ],
        ],
```        

## Usage

```
use hakeem23\yii2\OpenMeetingsSoap\OpenMeetingsSoap;

$client = new OpenMeetingsSoap('userName','Password');

$client->getVersion();
```

## Services

1. UserService

  - add => addUser($user, $confirm)
  
  - get => getUser()
  
  - kick => kickUser($uid)
  
  - count => countUser($roomid)
  
  - getRoomHash => getRoomHashUser($user, $options)
  
  - delete => deleteUser($id)
  
  - deleteExternal =>  deleteExternalUser($externaltype, $externalid)
  
  - login => loginUser($user= null, $pass = null)
  
2. RoomService

  - getExternal =>getExternalRoom($type, $externaltype, $externalid, $room)
  
  - add =>addRoom($room)
  
  - counters => countersRoom($id)
  
  - kick => kickRoom($id)
  
  - getPublic => getPublicRoom($type)
  
  - getRoomById => getRoomById($id)
  
  - hash => hashRoom($invite, $sendmail)
  
  - open => openRoom($id)
  
  - close =>closeRoom($id)
  
  - delete => deleteRoom($id)
  
3. InfoService

  - getVersion  => getVersion()
  
4. CalendarService

  - getByTitle => getByTitleCalendar($title)
  
  - next => nextCalendar()
  
  - nextForUser => nextForUserCalendar($userid)
  
  - getByRoom => getByRoomCalendar($roomid)
  
  - range => rangeCalendar($start, $end)
  
  - rangeForUser => rangeForUserCalendar($userid, $start, $end)
  
  - save => saveCalendar($appointment)
  
  - delete => deleteCalendar($id)
  
5. ErrorService

  - report => reportError($message)
  
  - get => getError($key, $lang)
  
6. FileService

  - move => moveFile($id, $roomid, $parentid)
  
  - add => addFile($file)
  
  - getRoomByParent => getRoomByParentFile($id, $parent)
  
  - getRoom => getRoomFile($id)
  
  - rename => renameFile($id, $name)
  
  - deleteExternal => deleteExternalFile( $externaltype, $externalid)
  
  - delete => deleteFile($id)
  
7. GroupService

  - add => addGroup($name)
  
  - get => getGroup()
  
  - addUser => addUserGroup($id, $userid)
  
  - getUsers => getUsersGroup( $id, $start, $max, $orderby= null, $asc)
  
  - addRoom => addRoomGroup($id, $roomid)
  
  - removeUser => removeUserGroup($id, $userid)
  
  - delete => deleteGroup($id)
  
8. RecordService

  - getExternal => getExternalRecord($externaltype, $externalid)
  
  - getExternalByRoom => getExternalByRoomRecord($roomid)
  
  - getExternalByType => getExternalByTypeRecord($externaltype)
  
  - delete => deleteRecord($id)

### for a complete list of the services provided please check 
http://openmeetings.apache.org/openmeetings-webservice/apidocs/index.html
