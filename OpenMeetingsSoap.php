<?php

namespace hakeem23\yii2\OpenMeetingsSoap;
use Yii;
class OpenMeetingsSoap {
    /**
     * @var
     */
    public $sid;
    public $room_id;
    public $hash_room;
    public $room_hash_user;
    public $group_id;
    /**
     * OpenMeetingsSoap constructor.
     * @param $user
     * @param $pass
     */
    public function __construct($user, $pass){
        $this->sid = $this->loginUser($user,$pass)->return->message;
    }

    /**
     * Info Service get Version
     * @return mixed
     */
    public function getVersion(){
        $client = Yii::$app->infoServices;
        return $client->getVersion()->return->version;
    }

    /**
     * Error Service report
     * @param null $message
     * @return mixed
     */
    public function reportError($message = null){
        $client = Yii::$app->errorService;
        return $client->report(['sid'=>$this->sid,'message'=>$message]);
    }

    /**
     * Error Service get
     * @param null $key
     * @param null $lang
     * @return mixed
     */
    public function getError($key=null, $lang=null){
        $client = Yii::$app->errorService;
        return $client->get(['key'=>$key,'lang'=>$lang]);
    }

    /*
     * $user(optional) =  [
     *  address(Optional)  =>[
     *      deleted,
     *      inserted(Optional) ,
     *      updated(Optional),
     *      additionalname(Optional),
     *      comment(Optional),
     *      country(Optional),
     *      email(Optional),
     *      fax(Optional),
     *      id(Optional),
     *      phone(Optional),
     *      street(Optional),
     *      town(Optional),
     *      zip(Optional)
     *  ]
     *  ,externalId(Optional)
     *  ,externalType(Optional)
     *  ,firstname(Optional)
     *  ,id(Optional)
     *  ,languageId(Optional)
     *  ,lastname(Optional)
     *  ,login(Optional)
     *  ,password(Optional)
     *  ,rights  <!--Zero or more repetitions:-->
     *  ,timeZoneId(Optional)
     *  ,type(Optional)
     * ]
     * ,$confirm(Optional)
     * User Service add
     * @param null $user
     * @param null $confirm
     * @return mixed
     */
    public function addUser($user = null, $confirm= null){
        $client = Yii::$app->userService;
        return $client->add(['sid'=>$this->sid,'user'=>$user,'confirm'=>$confirm]);
    }

    /**
     * User Service Count
     * @param null $roomid
     * @return mixed
     */
    public function countUser($roomid=null){
        $client = Yii::$app->userService;
        return $client->count(['sid'=>$this->sid,'roomid'=>$roomid]);
    }

    /**
     * User Service Delete
     * @param $id
     * @return mixed
     */
    public function deleteUser($id){
        $client = Yii::$app->userService;
        return $client->delete(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * User Service Delete External
     * @param null $externaltype
     * @param null $externalid
     * @return mixed
     */
    public function deleteExternalUser($externaltype= null, $externalid = null){
        $client = Yii::$app->userService;
        return $client->deleteExternal(['sid'=>$this->sid,
            'externaltype'=>$externaltype,
            'externalid'=>$externalid]);
    }

    /**
     * User Service get
     * @return mixed
     */
    public function getUser(){
        $client = Yii::$app->userService;
        return $client->get(['sid'=>$this->sid]);
    }
    /*
     * $user(Optional) = [
     *      login(Optional),
     *      firstname(Optional),
     *      lastname(Optional),
     *      profilePictureUrl(Optional),
     *      email(Optional),
     *      externalId(Optional),
     *      externalType(Optional)
     *  ],
     *  $options(Optional) = [
     *      roomId(Optional),
     *      recordingId(Optional),
     *      moderator,
     *      showAudioVideoTest,
     *      allowSameURLMultipleTimes,
     *      allowRecording
     *  ]
     * @param null $user
     * @param null $options
     * @return mixed
     */
    public function getRoomHashUser($user = null, $options = null){
        $client = Yii::$app->userService;
        $this->room_hash_user = $client->getRoomHash(['sid'=>$this->sid,'user'=>$user,'options'=>$options])->return->message;
        return $this->room_hash_user;
    }

    /**
     * User Service kick
     * @param null $uid
     * @return mixed
     */
    public function kickUser($uid = null){
        $client = Yii::$app->userService;
        return $client->kick(['sid'=>$this->sid,$uid]);
    }

    /**
     * User Service login
     * @param null $user
     * @param null $pass
     * @return mixed
     */
    public function loginUser($user= null, $pass = null){
        $client = Yii::$app->userService;
        return $client->login(['user'=>$user,'pass'=>$pass]);
    }
    /* $room(Optional)=[
     *      id(Optional),
     *      name(Optional),
     *      comment(Optional),
     *      type(Optional),
     *      capacity(Optional),
     *      appointment(Optional),
     *      confno(Optional),
     *      isPublic,
     *      demo,
     *      closed,
     *      demoTime(Optional),
     *      externalId(Optional),
     *      externalType(Optional),
     *      redirectUrl(Optional),
     *      moderated,
     *      allowUserQuestions,
     *      allowRecording,
     *      waitForRecording,
     *      audioOnly
     *      hiddenElements <!--Zero or more repetitions:--> ex['MicrophoneStatus','Whiteboard']
     *      files<!--Zero or more repetitions:--> = [
     *          id(Optional),
     *          fileId,
     *          wbIdx
     *      ]
     *  ]
     * Room Service add
     * @param array $room
     * @return mixed
     */
    public function addRoom($room = null){
        $client = Yii::$app->roomService;
        $data = $client->add(['sid'=>$this->sid,'room'=>$room]);
        $this->room_id =  $data->return->id;
        return $data;
    }

    /**
     * Room Service close
     * @param $id
     * @return mixed
     */
    public function closeRoom($id){
        $client = Yii::$app->roomService;
        return $client->close(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Room Service counters
     * @param $id <!--Zero or more repetitions:-->
     * @return mixed
     */
    public function countersRoom($id){
        $client = Yii::$app->roomService;
        return $client->counters(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Room Service delete
     * @param $id
     * @return mixed
     */
    public function deleteRoom($id){
        $client = Yii::$app->roomService;
        return $client->delete(['sid'=>$this->sid,'id'=>$id]);
    }
    /*
     * $room(Optional)= [
     *      id(Optional),
     *      name(Optional),
     *      comment(Optional),
     *      type(Optional),
     *      capacity(Optional),
     *      appointment,
     *      confno(Optional),
     *      isPublic,
     *      demo,
     *      closed,
     *      demoTime(Optional),
     *      externalId(Optional),
     *      externalType(Optional),
     *      redirectUrl(Optional),
     *      moderated,
     *      allowUserQuestions,
     *      allowRecording,
     *      waitForRecording,
     *      audioOnly,
     *      hiddenElements<!--Zero or more repetitions:-->
     *      files<!--Zero or more repetitions:--> = [
     *          id(Optional),
     *          fileId,
     *          wbIdx
     *      ]
     *  ]
     * Room Service getExternal
     * @param null $type
     * @param null $externaltype
     * @param null $externalid
     * @param null $room
     * @return mixed
     */
    public function getExternalRoom($type = null, $externaltype = null, $externalid = null, $room = null){
        $client = Yii::$app->roomService;
        $data =  $client->getExternal([
            'sid'=>$this->sid,
            'type'=>$type,
            'externaltype'=>$externaltype,
            'externalid'=>$externalid,
            'room'=>$room]);
        $this->room_id = $data->return->id;
        return $data;
    }

    /**
     * Room Service getPublic
     * @param null $type
     * @return mixed
     */
    public function getPublicRoom($type = null){
        $client = Yii::$app->roomService;
        return $client->getPublic(['sid'=>$this->sid,'type'=>$type]);
    }

    /**
     * Room Service getRoomById
     * @param null $id
     * @return mixed
     */
    public function getRoomById($id = null ){
        $client = Yii::$app->roomService;
        return $client->getRoomById(['sid'=>$this->sid,'id'=>$id]);
    }
    /*
     * $invite = [
     *      email(Optional),
     *      firstname(Optional),
     *      lastname(Optional),
     *      message(Optional),
     *      subject(Optional),
     *      roomId(Optional),
     *      passwordProtected,
     *      password(Optional),
     *      valid(Optional) enum('OneTime','Period','Endless'),
     *      validFrom(Optional),
     *      validTo(Optional),
     *      languageId
     * ]
     * Room Service hash
     * @param null $invite
     * @param $sendmail
     * @return mixed
     */
    public function hashRoom($invite =null, $sendmail){
        $client = Yii::$app->roomService;
        $this->hash_room = $client->hash(['sid'=>$this->sid,'invite'=>$invite,'sendmail'=>$sendmail])->return->message;
        return $this->hash_room;
    }

    /**
     * Room Service kick
     * @param $id
     * @return mixed
     */
    public function kickRoom($id){
        $client = Yii::$app->roomService;
        return $client->kick(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Room Service open
     * @param $id
     * @return mixed
     */
    public function openRoom($id){
        $client = Yii::$app->roomService;
        return $client->open(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Calendar Service open
     * @param null $id
     * @return mixed
     */
    public function deleteCalendar($id = null){
        $client = Yii::$app->calendarService;
        return $client->delete(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Calendar Service getByRoom
     * @param $roomid
     * @return mixed
     */
    public function getByRoomCalendar($roomid){
        $client = Yii::$app->calendarService;
        return $client->getByRoom(['sid'=>$this->sid,'roomid'=>$roomid]);
    }

    /**
     * Calendar Service getByTitle
     * @param null $title
     * @return mixed
     */
    public function getByTitleCalendar($title = null){
        $client = Yii::$app->calendarService;
        return $client->getByTitle(['sid'=>$this->sid,'title'=>$title]);
    }

    /**
     * Calendar Service next
     * @return mixed
     */
    public function nextCalendar(){
        $client = Yii::$app->calendarService;
        return $client->next(['sid'=>$this->sid]);
    }

    /**
     * Calendar Service nextForUser
     * @param $userid
     * @return mixed
     */
    public function nextForUserCalendar($userid){
        $client = Yii::$app->calendarService;
        return $client->nextForUser(['sid'=>$this->sid,'userid'=>$userid]);
    }

    /**
     * Calendar Service range
     * @param null $start
     * @param null $end
     * @return mixed
     */
    public function rangeCalendar($start = null, $end = null){
        $client = Yii::$app->calendarService;
        return $client->range(['sid'=>$this->sid,'start'=>$start,'end'=>$end]);
    }
    /**
     * Calendar Service rangeForUser
     * @param $userid
     * @param null $start
     * @param null $end
     * @return mixed
     */
    public function rangeForUserCalendar($userid, $start = null, $end = null){
        $client = Yii::$app->calendarService;
        return $client->rangeForUser(['sid'=>$this->sid,'userid'=>$userid,'start'=>$start,'end'=>$end]);
    }
    /*
     * $appointment(Optional) = [
     *      id(Optional),
     *      title(Optional),
     *      location(Optional),
     *      start(Optional),
     *      end(Optional),
     *      description(Optional),
     *      owner(Optional)=[
     *          address(Optional) =[
     *              deleted,
     *              inserted(Optional),
     *              updated(Optional),
     *              additionalname(Optional),
     *              comment(Optional),
     *              country(Optional),
     *              email(Optional),
     *              fax(Optional),
     *              id(Optional),
     *              phone(Optional),
     *              street(Optional),
     *              town(Optional),
     *              zip(Optional)
     *          ],
     *          externalId(Optional),
     *          externalType(Optional),
     *          firstname(Optional),
     *          id(Optional),
     *          languageId(Optional),
     *          lastname(Optional),
     *          login(Optional),
     *          password(Optional),
     *          rights<!--Zero or more repetitions:-->,
     *          timeZoneId(Optional),
     *          type(Optional)
     *      ],
     *      inserted(Optional),
     *      updated(Optional),
     *      deleted,
     *      reminder(Optional),
     *      room(Optional)=[
     *      id(Optional),
     *      name(Optional),
     *      comment(Optional),
     *      type(Optional),
     *      capacity(Optional),
     *      appointment,
     *      confno(Optional),
     *      isPublic,demo,
     *      closed,
     *      demoTime(Optional),
     *      externalId(Optional),
     *      externalType(Optional),
     *      redirectUrl(Optional),
     *      moderated,
     *      allowUserQuestions,
     *      allowRecording,
     *      waitForRecording,
     *      audioOnly,
     *      hiddenElements<!--Zero or more repetitions:-->
     *      files<!--Zero or more repetitions:--> = [
     *          id(Optional),
     *          fileId,
     *          wbIdx
     *      ]
     *  ],
     *  icalId(Optional),
     *  meetingMembers<!--Zero or more repetitions:--> = [
     *      id(Optional),
     *          user(Optional)=[
     *              address(Optional)=[
     *              deleted,
     *              inserted(Optional),
     *              updated(Optional),
     *              additionalname(Optional),
     *              comment(Optional),
     *              country(Optional),
     *              email(Optional),
     *              fax(Optional),
     *              id(Optional),
     *              phone(Optional),
     *              street(Optional),
     *              town(Optional),
     *              zip(Optional)
     *          ],
     *      externalId(Optional),
     *      externalType(Optional),
     *      firstname(Optional),
     *      id(Optional),
     *      languageId(Optional),
     *      lastname(Optional),
     *      login(Optional),
     *      password(Optional),
     *      rights<!--Zero or more repetitions:-->,
     *      timeZoneId(Optional),
     *      type(Optional)
     *      ],
     *      languageId(Optional),
     *      password(Optional),
     *      passwordProtected,
     *      connectedEvent,
     *      reminderEmailSend
     *  ]
     * ]
     * Calendar Service save
     * @param null $sid
     * @param null $appointment
     * @return mixed
     */
    public function saveCalendar($appointment = null){
        $client = Yii::$app->calendarService;
        return $client->save(['sid'=>$this->sid,'appointment'=>$appointment]);
    }
    //
    /* $file(Optional)= [
     *      id(Optional),
     *      name(Optional),
     *      hash(Optional),
     *      parentId(Optional),
     *      roomId(Optional),
     *      groupId(Optional),
     *      ownerId(Optional),
     *      size(Optional),
     *      externalId(Optional),
     *      externalType(Optional),
     *      type(Optional),
     *      width(Optional),
     *      height(Optional)
     *  ]
     * File Service add
     * @param null $file
     * @return mixed
     */
    public function addFile($file = null){
        $client = Yii::$app->fileService;
        return $client->add(['sid'=>$this->sid,'file'=>$file]);
    }

    /**
     * File Service delete
     * @param null $id
     * @return mixed
     */
    public function deleteFile($id = null){
        $client = Yii::$app->fileService;
        return $client->delete(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * File Service delete
     * @param null $externaltype
     * @param null $externalid
     * @return mixed
     */
    public function deleteExternalFile( $externaltype = null, $externalid= null){
        $client = Yii::$app->fileService;
        return $client->deleteExternal(['sid'=>$this->sid,'externaltype'=>$externaltype,'externalid'=>$externalid]);
    }

    /**
     * File Service getRoom
     * @param null $id
     * @return mixed
     */
    public function getRoomFile($id = null){
        $client = Yii::$app->fileService;
        return $client->getRoom(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * File Service getRoomByParent
     * @param $id
     * @param $parent
     * @return mixed
     */
    public function getRoomByParentFile($id, $parent){
        $client = Yii::$app->fileService;
        return $client->getRoomByParent(['sid'=>$this->sid,'id'=>$id,'parent'=>$parent]);
    }
    /**
     * File Service move
     * @param $id
     * @param $roomid
     * @param $parentid
     * @return mixed
     */
    public function moveFile($id, $roomid, $parentid){
        $client = Yii::$app->fileService;
        return $client->move(['sid'=>$this->sid,'id'=>$id,'roomid'=>$roomid,'parentid'=>$parentid]);
    }
    /**
     * File Service rename
     * @param $id
     * @param null $name
     * @return mixed
     */
    public function renameFile($id, $name = null){
        $client = Yii::$app->fileService;
        return $client->rename(['sid'=>$this->sid,'id'=>$id,'name'=>$name]);
    }

    /**
     * Group Service add
     * @param null $name
     * @return mixed
     */
    public function addGroup($name = null){
        $client = Yii::$app->groupService;
        $this->group_id = $client->add(['sid'=>$this->sid,'name'=>$name])->return->message;
        return $this->group_id;
    }

    /**
     * Group Service addRoom
     * @param null $id
     * @param $roomid
     * @return mixed
     */
    public function addRoomGroup($id = null, $roomid){
        $client = Yii::$app->groupService;
        return $client->addRoom(['sid'=>$this->sid,'id'=>$id,'roomid'=>$roomid]);
    }

    /**
     * Group Service addUser
     * @param null $id
     * @param $userid
     * @return mixed
     */
    public function addUserGroup($id = null, $userid){
        $client = Yii::$app->groupService;
        return $client->addUser(['sid'=>$this->sid,'id'=>$id,'userid'=>$userid]);
    }
    /**
     * Group Service delete
     * @param $id
     * @return mixed
     */
    public function deleteGroup($id){
        $client = Yii::$app->groupService;
        return $client->delete(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Group Service get
     * @return mixed
     */
    public function getGroup(){
        $client = Yii::$app->groupService;
        return $client->get(['sid'=>$this->sid]);
    }
    /**
     * Group Service get
     * @param $id
     * @param $start
     * @param $max
     * @param null $orderby
     * @param $asc
     * @return mixed
     */
    public function getUsersGroup( $id, $start, $max, $orderby= null, $asc){
        $client = Yii::$app->groupService;
        return $client->getUsers(['sid'=>$this->sid,'id'=>$id,'start'=>$start,'max'=>$max,'orderby'=>$orderby,'asc'=>$asc]);
    }

    /**
     * Group Service delete
     * @param null $sid
     * @param null $id
     * @param $userid
     * @return mixed
     */
    public function removeUserGroup($id= null, $userid){
        $client = Yii::$app->groupService;
        return $client->removeUser(['sid'=>$this->sid,'id'=>$id,'userid'=>$userid]);
    }

    /**
     * Record Service delete
     * @param null $id
     * @return mixed
     */
    public function deleteRecord($id= null){
        $client = Yii::$app->recordingService;
        return $client->delete(['sid'=>$this->sid,'id'=>$id]);
    }

    /**
     * Record Service getExternal
     * @param null $externaltype
     * @param null $externalid
     * @return mixed
     */
    public function getExternalRecord($externaltype= null, $externalid = null){
        $client = Yii::$app->recordingService;
        return $client->getExternal(['sid'=>$this->sid,'externaltype'=>$externaltype,'externalid'=>$externalid]);
    }

    /**
     * Record Service getExternalByRoom
     * @param null $roomid
     * @return mixed
     */
    public function getExternalByRoomRecord($roomid= null){
        $client = Yii::$app->recordingService;
        return $client->getExternalByRoom(['sid'=>$this->sid,'roomid'=>$roomid]);
    }

    /**
     * Record Service getExternalByType
     * @param null $externaltype
     * @return mixed
     */
    public function getExternalByTypeRecord($externaltype= null){
        $client = Yii::$app->recordingService;
        return $client->getExternalByType(['sid'=>$this->sid,'externaltype'=>$externaltype]);
    }

}

?>
