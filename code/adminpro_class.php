<?php
class protect{

var $errorMsg="";
var $showPage=false;

function protect($isAdmin=false,$userGroup=false){
include("adminpro_config.php");
include("mysql_dialog.php");
$this->accNoCookies=$globalConfig['acceptNoCookies'];
$this->dbhost=$globalConfig['dbhost'];
$this->dbuser=$globalConfig['dbuser'];
$this->dbpass=$globalConfig['dbpass'];
$this->dbase=$globalConfig['dbase'];
$this->tbl=$globalConfig['tbl'];
$this->tblID=$globalConfig['tblID'];
$this->tblUserName=$globalConfig['tblUserName'];
$this->tblUserPass=$globalConfig['tblUserPass'];
$this->tblIsAdmin=$globalConfig['tblIsAdmin'];
$this->tblUserGroup=$globalConfig['tblUserGroup'];
$this->tblSessionID=$globalConfig['tblSessionID'];
$this->tblLastLog=$globalConfig['tblLastLog'];
$this->tblUserRemark=$globalConfig['tblUserRemark'];
$this->inactiveMin=$globalConfig['inactiveMin'];
$this->loginUrl=$globalConfig['loginUrl'];
$this->logoutUrl=$globalConfig['logoutUrl'];
$this->enblRemember=$globalConfig['enblRemember'];
$this->cookieRemName=$globalConfig['cookieRemName'];
$this->cookieRemPass=$globalConfig['cookieRemPass'];
$this->cookieExpDays=$globalConfig['cookieExpDays'];
$this->isMd5=$globalConfig['isMd5'];
$this->errorPageTitle=$globalConfig['errorPageTitle'];
$this->errorPageH1=$globalConfig['errorPageH1'];
$this->errorPageLink=$globalConfig['errorPageLink'];
$this->errorNoCookies=$globalConfig['errorNoCookies'];
$this->errorNoLogin=$globalConfig['errorNoLogin'];
$this->errorInvalid=$globalConfig['errorInvalid'];
$this->errorDelay=$globalConfig['errorDelay'];
$this->errorNoAdmin=$globalConfig['errorNoAdmin'];
$this->errorNoGroup=$globalConfig['errorNoGroup'];
$this->errorCssUrl=$globalConfig['errorCssUrl'];
$this->errorCharset=$globalConfig['errorCharset'];
session_start();
$this->isAdmin=$isAdmin;
$this->userGroup=$userGroup;
$this->checkSession();
}

function checkSession(){
if (!$this->hasCookie() && $this->accNoCookies && (@$_POST['action']!="login" || @$_GET)){
$this->errorMsg=$this->errorNoCookies;
$this->makeErrorHtml();
}
else{
if (!@$_SESSION['userID'] || !@$_SESSION['sessionID']) {
$this->checkRemember();
}
elseif (@$_SESSION['userID'] && @$_SESSION['sessionID']) {
if (@$_POST['action']=="logout") {
$this->makeLogout();
}
else{
$this->checkTime();
}
}
}
}

function hasCookie(){
if ( isset($_COOKIE[session_name()])) {
return true;
}
else {
return false;
}
}
function makeLogout(){
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="UPDATE ".$this->tbl." SET ";
$SQL.=$this->tblLastLog."= 0, ";
$SQL.=$this->tblSessionID."='' ";
$SQL.="WHERE ".$this->tblID."='".$_SESSION['userID']."'";
$db->speak($SQL);
if ($this->enblRemember && isset($_COOKIE[$this->cookieRemName]) && isset($_COOKIE[$this->cookieRemPass])){
setcookie($this->cookieRemName,$_COOKIE[$this->cookieRemName],time());
setcookie($this->cookieRemPass,$_COOKIE[$this->cookieRemPass],time());
}
session_destroy();
header ("Location: ".$this->logoutUrl);
}

function checkTime(){
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="SELECT UNIX_TIMESTAMP(".$this->tblLastLog.") as lastLog FROM ".$this->tbl;
$SQL.=" WHERE ".$this->tblID."=".$_SESSION['userID']." AND ".$this->tblSessionID."='".$_SESSION['sessionID']."'";
$db->speak($SQL);
$data=$db->listen();
$nowtime=time();
$inactiveSec=$nowtime-$data['lastLog'];
if ($inactiveSec/60>$this->inactiveMin) {
$this->errorMsg=$this->errorDelay;
$this->makeErrorHtml();
}
else {
$SQ="UPDATE ".$this->tbl." SET ";
$SQ.=$this->tblLastLog."= now() ";
$SQ.="WHERE ".$this->tblID."='".$_SESSION['userID']."'";
$db->speak($SQ);
$this->checkAdmin();
}
}
function checkAdmin(){
if ($this->isAdmin!="1") {
$this->checkGroup();
}
else{
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="SELECT ".$this->tblIsAdmin." as isAdmin FROM ".$this->tbl;
$SQL.=" WHERE ".$this->tblID."=".$_SESSION['userID']." AND ";
$SQL.=$this->tblSessionID."='".$_SESSION['sessionID']."'";
$db->speak($SQL);
$data=$db->listen();
if ($data['isAdmin']==-1){
$this->errorMsg=$this->errorNoAdmin;
header( 'Location: ./first_page2.php' ) ;
}
elseif ($data['isAdmin']==1){
$this->showPage();
}
}
}
function checkGroup(){
if (!$this->userGroup){
$this->showPage();
}
else {
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="SELECT ".$this->tblUserGroup." as userGroup, ";
$SQL.=$this->tblIsAdmin." as isAdmin";
$SQL.=" FROM ".$this->tbl;
$SQL.=" WHERE ".$this->tblID."=".$_SESSION['userID']." AND ";
$SQL.=$this->tblSessionID."='".$_SESSION['sessionID']."'";
$db->speak($SQL);
$data=$db->listen();
if ($data['userGroup']!=$this->userGroup && $data['isAdmin']!=1){
$this->errorMsg=$this->errorNoGroup;
$this->makeErrorHtml();
}
else{
$this->showPage();
}
}
}
function checkRemember(){
if ($this->enblRemember && isset($_COOKIE[$this->cookieRemName]) && isset($_COOKIE[$this->cookieRemPass])){
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="SELECT ".$this->tblID." as ID, ";
$SQL.=$this->tblUserName." as userName, ";
$SQL.=$this->tblUserPass." as userPass ";
$SQL.="FROM ".$this->tbl;
$SQL.=" WHERE ".$this->tblUserName."='".$_COOKIE[$this->cookieRemName]."'";
$db->speak($SQL);
$data=$db->listen();

if ($this->isMd5!="1" && $data['userPass']){
$data['userPass']=md5($data['userPass']);
}

if ($_COOKIE[$this->cookieRemName]==$data['userName'] && $_COOKIE[$this->cookieRemPass]==$data['userPass']){
$SQL="UPDATE ".$this->tbl." SET ";
$SQL.=$this->tblLastLog."= now(), ";
$SQL.=$this->tblSessionID."='".session_id()."' ";
$SQL.="WHERE (".$this->tblID."='".$data['ID']."')";
$db->speak($SQL);
$_SESSION['sessionID']=session_id();
$_SESSION['userID']=$data['ID'];
setcookie($this->cookieRemName,$_COOKIE[$this->cookieRemName],time()+(60*60*24*$this->cookieExpDays));
setcookie($this->cookieRemPass,$_COOKIE[$this->cookieRemPass],time()+(60*60*24*$this->cookieExpDays));
$this->checkSession();
}

}
else {
$this->checkPost();
}
}

function checkPost(){
if (!$_POST) {
$this->errorMsg=$this->errorNoLogin;
$this->makeErrorHtml();
}
else {
$this->checkLogin();
}
}
/*
**** @function: checkLogin (called by checkPost())
**** checks if some $_POST['userName'] and $_POST['userPass'] and $_POST['action']="login" was sent;
**** If not -> it creates an error page;
**** if yes -> it compares the $_POST with the username and password on database;
**** if all ok -> showPage() else -> it creates an error page;
*/
function checkLogin(){
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$action=@$_POST['action'];
$userName=@$_POST['userName'];
if ($this->isMd5=="1"){
$userPass=md5(@$_POST['userPass']);
}
else {
$userPass=@$_POST['userPass'];
}
$SQL="SELECT ".$this->tblID." as ID, ";
$SQL.=$this->tblUserName." as userName, ";
$SQL.=$this->tblUserPass." as userPass ";
$SQL.="FROM ".$this->tbl;
$SQL.=" WHERE ".$this->tblUserName."='".$userName."' ";
$SQL.="and ".$this->tblUserPass."='".$userPass."'";
$db->speak($SQL);
$data=$db->listen();
if ($action=="login" && ($userName || $userPass)){
if ($userName==$data['userName'] && $userPass==$data['userPass']) {
$SQL="UPDATE ".$this->tbl." SET ";
$SQL.=$this->tblLastLog."= now(), ";
$SQL.=$this->tblSessionID."='".session_id()."' ";
$SQL.="WHERE (".$this->tblID."='".$data['ID']."')";
$db->speak($SQL);
$_SESSION['sessionID']=session_id();
$_SESSION['userID']=$data['ID'];
if ($this->enblRemember && @$_POST['userRemember']=="yes"){
setcookie($this->cookieRemName,@$_POST['userName'],time()+(60*60*24*$this->cookieExpDays));
setcookie($this->cookieRemPass,md5(@$_POST['userPass']),time()+(60*60*24*$this->cookieExpDays));
}
$this->checkSession();
}
}
if ($action=="login"){
if ($userName!=$data['userName'] || $userPass!=$data['userPass'] || $userName=="" || $userPass=="") {
$this->errorMsg=$this->errorInvalid;
$this->makeErrorHtml();
}
}
if ($action!="login") {
$this->errorMsg=$this->errorInvalid;
$this->makeErrorHtml();
}
}
function makeErrorHtml() {
if ($_SESSION){
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="UPDATE ".$this->tbl." SET ";
$SQL.=$this->tblLastLog."= 0, ";
$SQL.=$this->tblSessionID."='' ";
$SQL.="WHERE ".$this->tblID."='".$_SESSION['userID']."'";
$db->speak($SQL);
}
if ($this->enblRemember && isset($_COOKIE[$this->cookieRemName]) && isset($_COOKIE[$this->cookieRemPass])){
setcookie($this->cookieRemName,$_COOKIE[$this->cookieRemName],time());
setcookie($this->cookieRemPass,$_COOKIE[$this->cookieRemPass],time());
}
session_destroy();
$out="<html>\n<head><title>".$this->errorPageTitle."</title>\n";
if ($this->errorCssUrl!=""){
$out.="<link rel=\"stylesheet\" type=\"text/css\" href=\"".$this->errorCssUrl."\">\n";
}
if ($this->errorCharset!=""){
$out.="<meta http-equiv=\"content-type\" content=\"text/html;charset=".$this->errorCharset."\">\n";
}
$out.="</head>\n<body>\n";
$out.="<div align='center' style='color:#00FF00'>";
$out.="<h1>".$this->errorPageH1."</h1>\n";
$out.="<p>".$this->errorMsg."</p>\n";
$out.="<p style='background:#ffffff'><a href=".$this->loginUrl.">".$this->errorPageLink."</a></p>\n";
$out.="<p style='background:#ffffff'><a href='index.php'>Return to home page</a></p>\n";

$out.="</div>";
$out.="</body>\n</html>";

print $out;
}
/*
**** @function: showPage
**** makes the public var $showPage true, if everything was ok;
*/
function showPage(){
$this->showPage=true;
}
/*
**** @function: getUser
**** call it in your protected page, if you would like to display the username;
*/
function getUser(){

if ($this->showPage){
$db=new mysql_dialog();
$db->connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbase);
$SQL="SELECT ".$this->tblUserName." as userName";
$SQL.=" FROM ".$this->tbl;
$SQL.=" WHERE ".$this->tblID."='".$_SESSION['userID']."'";
$db->speak($SQL);
$data=$db->listen();
return $data['userName'];
}
else {return false;}
}

}
?>
